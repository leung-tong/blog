<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use Notifiable;

    // 获取菜单
    static public function getMenus(): string
    {
        $menus = $menus = DB::table('menus')->select(['id', 'name', 'pid', 'icon', 'url'])
            ->get()->map(function ($value) {
                return (array)$value;
            })->toArray();

        return json_encode(self::loopMenu($menus), JSON_UNESCAPED_UNICODE);
    }

    // 递归菜单
    static private function loopMenu($array, $pid = 0): array
    {
        $data = array();
        foreach ($array as $k => $v) {       //PID符合条件的
            if ($v['pid'] == $pid) {         //寻找子集
                $child = self::loopMenu($array, $v['id']);   //加入数组
                $v['childMenus'] = $child ?: array();
                $data[] = $v;//加入数组中
            }
        }
        return $data;
    }
}
