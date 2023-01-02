<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Models\UserGroupModel;
use App\Http\Requests\UserRequest as MainRequest;
use Illuminate\Support\Facades\DB;

class UserController extends AdminController
{
    private $userGroupModel;
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.user.';
        $this->controllerName     = 'user';
        $this->model = new MainModel();
        $this->userGroupModel = new UserGroupModel();
        parent::__construct();
    }

    public function form(Request $request)
    {
        $item = null;
        $groupUserItems = $this->userGroupModel->listItems(null, ['task' => 'admin-list-items']);
        $permissions  = DB::table('permission')->select('*')->get()->toArray();

        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'groupUserItems' => $groupUserItems,
            'permissions'   => $permissions,
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

    public function changeLevel(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-level-post']);
            return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi level thành công!");
        }
    }

    public function changePassword(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi mật khẩu thành công!");
        }
    }

    public function changePermission(Request $request)
    {
        $params["currentPermission"]   = $request->permission;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-permission']);
        return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi quyền thành công!");
    }

    public function changePermissionDeny(Request $request)
    {
        $params = $request->all();
        if(isset($params['permission_deny'])) {
            $params['permission_deny'] = json_encode($params['permission_deny']);
        } else {
            $params['permission_deny'] = null;
        }
        $this->model->saveItem($params, ['task' => 'change-permission-deny']);
        return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi quyền thành công!");
    }

    public function changePermissionAllow(Request $request)
    {
        $params = $request->all();
        if(isset($params['permission_allow'])) {
            $params['permission_allow'] = json_encode($params['permission_allow']);
        } else {
            $params['permission_allow'] = null;
        }
        $this->model->saveItem($params, ['task' => 'change-permission-allow']);
        return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi quyền thành công!");
    }

    public function level(Request $request)
    {
        $params["currentLevel"]   = $request->level;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-level']);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
