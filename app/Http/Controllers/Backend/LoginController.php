<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        if ($request->isMethod('get')) {
            return view('backend.login');
        }

        $params = $request->only('username', 'password');

        if (Auth::attempt($params)) {
            return JsonResponse::success('登录成功');
        }

        return JsonResponse::fail('账号密码错误');
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/admin/login');
    }

}
