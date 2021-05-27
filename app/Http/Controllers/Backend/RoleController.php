<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Services\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $Role;

    public function __construct()
    {
        $this->Role = new Role();
    }

    public function index(Request $request){
        if ($request->isMethod('get')){
            return view('backend.role.index');
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
        $list = $this->Role->getList($params);
        $count = $this->Role->getCount($where ?? []);

        return JsonResponse::success('成功', $list, 0, ['count' => $count, 'page' => $params['page'], 'limit' => $params['pagesize']]);
    }

    public function insert(Request $request){
        if (empty($request->get('name'))){
            return JsonResponse::fail('名称不能为空');
        }
        $this->Role->name = $request->get('name');
        $this->Role->state = $request->get('state');
        if(!$this->Role->save()){
            return JsonResponse::fail('添加失败');
        }
        return JsonResponse::success('添加成功');
    }

    public function update(Request $request)
    {
        if (!$this->Role->updateRole($request->only(['id', 'name', 'state']))) {
            return JsonResponse::fail('修改失败');
        }
        return JsonResponse::success('修改成功');
    }

    public function delete(Request $request)
    {
        $ids = is_string($request->get('id')) ? explode(',', $request->get('id')) : $request->get('id');

        $res = $this->Role->deleteById($ids);
        if (!$res) {
            return JsonResponse::fail('删除失败');
        }
        return JsonResponse::success('删除成功');
    }
}
