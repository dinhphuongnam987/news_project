<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\MenuModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;

class MenuController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.menu.';
        $this->controllerName     = 'menu';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 5;
        parent::__construct();
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
    
    public function typeMenu(Request $request)
    {
        $params["currentTypeMenu"]   = $request->type_menu;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-type-menu']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function typeOpenMenu(Request $request)
    {
        $params["currentTypeOpenMenu"]   = $request->type_open_menu;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-type-open-menu']);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
