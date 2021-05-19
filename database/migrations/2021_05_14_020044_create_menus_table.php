<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default(0)->comment('父级菜单id');
            $table->integer('weight')->default(100)->comment('父级菜单id');
            $table->string('name', 25)->default('')->comment('菜单名称');
            $table->string('icon', 255)->default('')->comment('图标');
            $table->string('url', 255)->default('')->comment('路径');
            $table->tinyInteger('display')->default(0)->comment('是否显示0正常,1禁用');
            $table->timestamps();
            $table->tinyInteger('del')->default(0)->comment('是否删除:1删除 0正常');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        DB::statement("ALTER TABLE `menus` comment '菜单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
