<?php

namespace App\Providers;

use App\Http\Controllers\Backend\MenuController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 加载导航栏数据
        View::share('Sidebar', (new MenuController)->sidebar());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
