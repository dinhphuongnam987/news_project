<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\SettingModel as MainModel;
use App\Http\Requests\SettingRequest as MainRequest;

class SettingController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.setting.';
        $this->controllerName     = 'setting';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function index(Request $request)
    {
        $key = $request->key;
        $page = 'index';
        $params['field'] = 'key_value';
        $params['field_value'] = 'general-setting';

        switch($key) {
            case 'email-setting': 
                $page = 'email';
                $params['field_value'] = 'email-setting'; 
                break;
            case 'social-setting':
                $page = 'social';
                $params['field_value'] = 'social-setting'; 
                break;
            case 'bank-setting':
                $page = 'bank';
                $params['field_value'] = 'bank-setting'; 
                break;
            case 'payment-time-setting':
                $page = 'payment_time';
                $params['field_value'] = 'payment-time-setting'; 
                break;
        }

        $item = $this->model->getItem($params, ['task' => 'get-item']);
        return view($this->pathViewController . $page, [
            'item' => $item,  
        ]);
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            if(isset($params['btn-general-setting'])) {
                $task = 'update-general-setting';
                $notify = 'Cập nhập cấu hình chung thành công!';
                $key = '';
            }

            if(isset($params['btn-email-setting'])) {
                $task = 'update-email-setting';
                $notify = 'Cập nhập cấu hình email thành công!';
                $key = 'email-setting';
            }
            
            if(isset($params['btn-social-setting'])) {
                $task = 'update-social-setting';
                $notify = 'Cập nhập cấu hình social thành công!';
                $key = 'social-setting';
            }

            if(isset($params['btn-bank-setting'])) {
                $task = 'update-bank-setting';
                $notify = 'Cập nhập cấu hình ngân hàng thành công!';
                $key = 'bank-setting';
            }

            if(isset($params['btn-payment-time-setting'])) {
                $task = 'update-payment-time-setting';
                $notify = 'Cập nhập cấu hình hạn thanh toán thành công!';
                $key = 'payment-time-setting';
            }

            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName, $key)->with("zvn_notify", $notify);
        }
    }
}
