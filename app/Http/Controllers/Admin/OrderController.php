<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\OrderModel as MainModel;
use App\Models\SettingModel;

class OrderController extends AdminController
{
    private $settingModel;
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.order.';
        $this->controllerName     = 'order';
        $this->model = new MainModel();
        $this->settingModel = new SettingModel();
        parent::__construct();
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        return view($this->pathViewController .  'form', [
            'item'        => $item,
        ]);
    }

    public function save(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }

    public function statusPayment(Request $request)
    {
        $params["currentstatusPayment"]   = $request->status_payment;
        $params["id"]                     = $request->id;

        $this->model->saveItem($params, ['task' => 'change-status-payment']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function billDetail(Request $request)
    {
        $params['MaHD'] = $request->MaHD;
        $params['field'] = 'key_value';
        $params['field_value'] = 'general-setting';

        $billDetail = $this->model->getItem($params, ['task' => 'get-bill-detail']);
        $generalSetting = $this->settingModel->getItem($params, ['task' => 'get-item']);

        return view($this->pathViewController .'bill-detail.index', compact('billDetail', 'generalSetting'));
    }

    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $result = $this->model->deleteItem($params, ['task' => 'delete-item']);
        $notify = 'Bạn chưa được phép xóa đơn hàng vì đang trong thời gian đợi thanh toán!';
        if($result) {
            $notify = 'Xóa phần tử thành công!';
        }
        return redirect()->route($this->controllerName)->with('zvn_notify', $notify);
    }
}
