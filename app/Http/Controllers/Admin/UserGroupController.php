<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\UserGroupModel as MainModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserGroupRequest as MainRequest;

class UserGroupController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.user_group.';
        $this->controllerName     = 'userGroup';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function index(Request $request)
    {
        $items        = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        $permissions  = DB::table('permission')->select('*')->get()->toArray();

        return view($this->pathViewController .  'index', [
            'items'         => $items,
            'permissions'   => $permissions,
        ]);
    }

    public function form(Request $request)
    {
        $item = null;
        $permissions = DB::table('permission')->select('*')->get()->toArray();
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'permissions' => $permissions,
        ]);
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            if(isset($params['permission_ids'])) {
                $params['permission_ids'] = json_encode($params['permission_ids']);
            }

            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if (isset($request->id) && $params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }

            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }
}
