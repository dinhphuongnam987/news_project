<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\UserModel as MainModel;
use App\Http\Requests\PasswordRequest as MainRequest;

class PasswordController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.password.';
        $this->controllerName     = 'password';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function changePassword(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            if(!empty(session('userInfo'))) $params['id'] = session('userInfo')['id'];

            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi mật khẩu thành công!");
        }
    }
}
