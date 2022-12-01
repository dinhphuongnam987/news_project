<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\ArticleModel as MainModel;
use App\Models\CategoryModel;
use App\Http\Requests\ArticleRequest as MainRequest;

class ArticleController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.article.';
        $this->controllerName     = 'article';
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

        $categoryModel  = new CategoryModel();
        $itemsCategory  = $categoryModel->listItems(null, ['task' => 'admin-list-items-in-select-box']);

        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'itemsCategory' => $itemsCategory
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

    public function type(Request $request)
    {
        $params["currentType"]    = $request->type;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-type']);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
