<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 清除所有菜单再重新加载
        DB::table('menus')->truncate();
        $date = date('Y-m-d H:i:s');
        $values = [
            # 一级菜单
            ['id' => 1, 'pid' => 0, 'weight' => 100, 'name' => '首页', 'icon' => 'layui-icon-home', 'url' => '/admin/index', 'created_at' => $date, 'updated_at' => $date],
            ['id' => 2, 'pid' => 0, 'weight' => 100, 'name' => '菜单管理', 'icon' => 'layui-icon-spread-left', 'url' => '', 'created_at' => $date, 'updated_at' => $date],
            ['id' => 3, 'pid' => 0, 'weight' => 100, 'name' => '角色管理', 'icon' => 'layui-icon-spread-left', 'url' => '/admin/role/index', 'created_at' => $date, 'updated_at' => $date],
            ['id' => 4, 'pid' => 0, 'weight' => 100, 'name' => '权限管理', 'icon' => 'layui-icon-auz', 'url' => '', 'created_at' => $date, 'updated_at' => $date],
            ['id' => 5, 'pid' => 0, 'weight' => 100, 'name' => '用户管理', 'icon' => 'layui-icon-user', 'url' => '', 'created_at' => $date, 'updated_at' => $date],


            # 二级级菜单
            ['id' => 6, 'pid' => 2, 'weight' => 100, 'name' => '菜单列表', 'icon' => 'layui-icon-list', 'url' => '/admin/menu/index', 'created_at' => $date, 'updated_at' => $date],
            ['id' => 7, 'pid' => 3, 'weight' => 100, 'name' => '角色列表', 'icon' => 'layui-icon-list', 'url' => '/admin/role/index', 'created_at' => $date, 'updated_at' => $date],
            ['id' => 8, 'pid' => 4, 'weight' => 100, 'name' => '权限列表', 'icon' => 'layui-icon-list', 'url' => '/admin/permission/index', 'created_at' => $date, 'updated_at' => $date],
            ['id' => 9, 'pid' => 5, 'weight' => 100, 'name' => '用户列表', 'icon' => 'layui-icon-list', 'url' => '/admin/user/index', 'created_at' => $date, 'updated_at' => $date],

            # 三级级菜单
        ];

        DB::table('menus')->insert($values);
        echo '生成菜单';
    }
}
