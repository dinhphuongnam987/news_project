<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Models\UserModel;

class AuthController extends Controller
{
    private $pathViewController = 'news.pages.auth.';  // slider
    private $controllerName     = 'auth';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function login(Request $request)
    {   
        return view($this->pathViewController . 'login');
    }

    // middelware
    

    public function postLogin(MainRequest $request)
    {   
        if ($request->method() == 'POST') {
            $params = $request->all();
            $urlCurrent = $request->session()->get('urlCurrent');
            $urlCurrent = isset($urlCurrent) ? $urlCurrent : route('dashboard');

            $userModel = new UserModel();
            $userInfo = $userModel->getItem($params, ['task' => 'auth-login']);

            if (!$userInfo)
                return redirect()->route($this->controllerName . '/login')->with('news_notify', 'Tài khoản hoặc mật khẩu không chính xác!');

            $request->session()->put('userInfo', $userInfo);
            return redirect($urlCurrent);
        }
    }

    public function logout(Request $request)
    {   
        if($request->session()->has('userInfo')) {
            $request->session()->pull('userInfo');
            $request->session()->pull('urlCurrent');
        }
        return redirect()->route('home');
    }

 
}