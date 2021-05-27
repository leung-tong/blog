<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        return $sql->offset($offset)->limit($params['pagesize'])->get()->toArray();
    }

    // 根据条件获取菜单列表总数
    public function getCount($where)
    {
        $sql = self::query();
        if (empty($params['where'])) {
            $sql->where($where);
        }
        return $sql->count();
    }

    // 根据Id更新
    public function updateMenu($params)
    {
        return self::query()->where('id', $params['id'])->update($params);
    }

    // 根据id软删除菜单
    public function deleteById($id)
    {
        return self::query()->whereIn('id',$id)->delete();
    }

    // 获取所有可用导航
    public function getSidebar()
    {
        $menus = self::query()->select(['id', 'name', 'pid', 'icon', 'url', 'state'])->where('state' , 0)->orderBy('weight', 'desc')->get()->toArray();
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
