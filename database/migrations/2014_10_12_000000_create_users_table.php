<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone',13)->default('')->comment('手机号');
            $table->string('username',25)->default('')->comment('用户名');
            $table->string('email',255)->default('')->comment('邮箱');
            $table->string('img',255)->default('')->comment('头像');
            $table->string('password',255)->default('')->comment('密码');
            $table->string('token')->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('state')->default(0)->comment('是否显示 -1删除,0正常,1禁用');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
        DB::statement("ALTER TABLE `users` comment '用户表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
