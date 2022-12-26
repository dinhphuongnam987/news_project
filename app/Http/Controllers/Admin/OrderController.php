<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\OrderModel as MainModel;
use App\Models\SettingModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Jobs\OrderSuccessMail;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $params['field'] = 'key_value';
        $params['field_value'] = 'general-setting';

        $this->model->saveItem($params, ['task' => 'change-status-payment']);
        $generalSetting = $this->settingModel->getItem($params, ['task' => 'get-item']);
        $order = $this->model->getItem($params, ['task' => 'get-item']);

        $params['MaHD'] =  $order['MaHD'];
        $billDetail = $this->model->getItem($params, ['task' => 'get-bill-detail']);

        if(!empty($billDetail) && $request->status_payment == 'paid') {
            $pdf = Pdf::loadView($this->pathViewController .'bill-detail.pdf.index', compact('billDetail', 'generalSetting'));
            $pdf_name = Str::slug($billDetail[0]['name']. '-'. $billDetail[0]['MaHD']) . '.pdf';
            $path = public_path('pdf');
            $pdf_path = $path .'/' .$pdf_name;
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0755, true, true);
            }
            $pdf->save($pdf_path);
            OrderSuccessMail::dispatch($order, $pdf_path)->onQueue('order-success-email');
        }
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

        $pdf = Pdf::loadView($this->pathViewController .'bill-detail.pdf.index', compact('billDetail', 'generalSetting'));
        if($request->pdf == 'view') {
            return $pdf->stream();
        } else if($request->pdf == 'download') {
            return $pdf->download($billDetail[0]['name']. '-'. $billDetail[0]['MaHD'] . '.pdf');
        }

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

    public function export() 
    {
        return Excel::download(new OrderExport, 'order.xlsx');
    }
}
