<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Services\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    protected $Menu;

    public function __construct()
    {
        $this->Menu = new Menu();
    }

    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('backend.menu/index');
        }

        $params['page'] = $request->get('page', 1);
        $params['pagesize'] = $request->get('limit', 15);

        if (!empty($request->get('name'))) {
            $where['name'] = $request->get('name');
        }

        $state = $request->get('state');
        if (isset($state)) {
            $where['state'] = $request->get('state');
        }

        $params['where'] = $where ?? [];
        // 获取菜单数据
        $list = $this->Menu->getList($params);
        $count = $this->Menu->getCount($where ?? []);

        return JsonResponse::success('成功', $list, 0, ['count' => $count, 'page' => $params['page'], 'limit' => $params['pagesize']]);
    }

//    public function insert(Request $request)
//    {
//        // 需要校验
//        if (!$this->Menu->insertMenu($request->only(['name', 'icon', 'url', 'weight', 'state']))) {
//            return JsonResponse::fail('添加失败');
//        }
//        return JsonResponse::success('添加成功');
//    }

    public function update(Request $request)
    {
        if (!$this->Menu->updateMenu($request->only(['id', 'name', 'icon', 'url', 'weight', 'state']))) {
            return JsonResponse::fail('修改失败');
        }
        return JsonResponse::success('修改成功');
    }

    public function delete(Request $request)
    {
        $ids = is_string($request->get('id')) ? explode(',', $request->get('id')) : $request->get('id');

        $res = $this->Menu->deleteById($ids);
        if (!$res) {
            return JsonResponse::fail('删除失败');
        }
        return JsonResponse::success('删除成功');
    }

    // 导航为全页面共享数据，返回写在providers/AppServiceProvider内
    public function sidebar()
    {
        $sidebar = $this->Menu->getSidebar();
        return json_encode($sidebar, JSON_UNESCAPED_UNICODE);
    }
}
