<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class Menu extends Model
{
    use Notifiable;

    // 根据条件获取菜单列表
    public function getList($params)
    {
        $sql = Menu::query();

        if (!empty($params['where'])) {
            $sql->where($params['where']);
        }

        $offset = ($params['page'] - 1) * $params['pagesize'];
        return $sql->where('del', 0)->offset($offset)->limit($params['pagesize'])->get()->toArray();
    }

    // 根据条件获取菜单列表总数
    public function getCount($where)
    {
        $sql = Menu::query();
        if (empty($params['where'])) {
            $sql->where($where);
        }
        return $sql->where('del', 0)->count();
    }

    // 根据Id更新
    public function updateMenu($params)
    {
        return Menu::query()->where('id', $params['id'])->update($params);
    }

    // 根据id软删除菜单
    public function deleteById($id)
    {
        return Menu::query()->whereIn('id',$id)->update(['del' => 1]);
    }

    // 获取所有可用导航
    public function getSidebar()
    {
        $menus = Menu::query()->select(['id', 'name', 'pid', 'icon', 'url', 'display'])->where(['display' => 0, 'del' => 0])->orderBy('weight', 'desc')->get()->toArray();
        return $this->loopSidebar($menus, 0);
    }

    // 导航无限级递归
    private function loopSidebar($array, $pid, $keyName = 'childMenus')
    {
        $data = array();
        foreach ($array as $k => $v) {       //PID符合条件的
            if ($v['pid'] == $pid) {         //寻找子集
                $child = self::loopSidebar($array, $v['id']);   //加入数组
                $v[$keyName] = $child ?: array();
                $data[] = $v;//加入数组中
            }
        }
        return $data;
    }
}
