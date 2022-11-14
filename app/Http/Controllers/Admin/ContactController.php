<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\ContactModel as MainModel;
use Illuminate\Http\Request;

class ContactController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.contact.';
        $this->controllerName     = 'contact';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function status(Request $request)
    {
        $params["currentStatus"]  = $request->status;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);
        $status = $request->status == 'contacted' ? 'uncontacted' : 'contacted';
        $link = route($this->controllerName . '/status', ['status' => $status, 'id' => $request->id]);
        return response()->json([
            'statusObj' => config('zvn.template.status')[$status],
            'link' => $link,
        ]);
    }
}
