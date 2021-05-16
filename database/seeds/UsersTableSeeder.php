<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //　创建超级管理员
        if(DB::table('users')->where('id',1)->doesntExist()){
            DB::table('users')->insert([
                'id' => 1,
                'phone' => '13944066881',
                'username' => 'root',
                'email' => 'leungtong@126.com',
                'img' => '/img/root.jpg',
                'password' => bcrypt('root123'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            echo '生成超级管理员';
        }
    }
}

