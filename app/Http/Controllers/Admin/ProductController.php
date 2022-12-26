<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\ProductModel as MainModel;
use App\Models\CategoryModel;
use App\Http\Requests\ProductRequest as MainRequest;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.product.';
        $this->controllerName     = 'product';
        $this->model = new MainModel();
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

    public function save(MainRequest $request)
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

    public function import(Request $request) {
        if (empty($request->file('excel_file'))) 
        {
            request()->validate([
                'excel_file'  => 'required|mimes:xls,xlsx,csv|max:2048',
            ]);
        } else {
            Excel::import(new ProductImport, $request->file('excel_file'));

            return back()->with('zvn_notify', 'Nhập thành công!');
        }
    }
}
