<?php

namespace App\Http\Controllers\Backend;

use App\Models\Permission;
use App\Services\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //
    protected $Permission;

    public function __construct()
    {
        $this->Permission = new Permission();
    }

    public function index(Request $request){
        if ($request->isMethod('get')){
            return view('backend.perm.index');
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
        $list = $this->Permission->getList($params);
        $count = $this->Permission->getCount($where ?? []);

        return JsonResponse::success('成功', $list, 0, ['count' => $count, 'page' => $params['page'], 'limit' => $params['pagesize']]);
    }

    public function insert(Request $request){
        if (empty($request->get('name'))){
            return JsonResponse::fail('名称不能为空');
        }
        if (empty($request->get('url'))){
            return JsonResponse::fail('名称不能为空');
        }

        $this->Permission->name = $request->get('name');
        $this->Permission->url = $request->get('url');
        $this->Permission->state = $request->get('state');
        var_dump($this->Permission->save());
    }

    public function update(Request $request)
    {
        if (!$this->Permission->updateRole($request->only(['id', 'name','url', 'state']))) {
            return JsonResponse::fail('修改失败');
        }
        return JsonResponse::success('修改成功');
    }

    public function delete(Request $request)
    {
        $ids = is_string($request->get('id')) ? explode(',', $request->get('id')) : $request->get('id');

        $res = $this->Permission->deleteById($ids);
        if (!$res) {
            return JsonResponse::fail('删除失败');
        }
        return JsonResponse::success('删除成功');
    }
}
