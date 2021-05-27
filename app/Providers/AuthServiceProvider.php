<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//        Gate::define('admin/user/index', 'PostPolicy@index');
        dd(\Auth::user());
//        dd(\Illuminate\Http\Request::route());
        // uid,get,admin/user/index
        // get
        // admin/user/index
        // session{perm:{{admin/user/index},{admin/menu/index}}}
        // session{perm:{{admin/user/index},{admin/menu/index}}}
        // {1,post,admin/user/index}
        // {1,post,admin/menu/index}

//        dd(Request::path());
//        dd(Request::url());
//        var_dump(1);


    }
}
