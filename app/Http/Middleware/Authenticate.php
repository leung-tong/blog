<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

// 登录权限认证中间件
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        var_dump(3);
        if (!Auth::guard($guard)->check()) {
            return redirect('/admin/login')->with('error','请登录后访问');
        }
//        // 登录后 将权限信息写入session中
        Auth::user()->role_id = 10;
        return $next($request);
    }


}
