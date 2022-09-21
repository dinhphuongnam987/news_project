<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\DashboardModel as MainModel;

class DashboardController extends AdminController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->pathViewController = 'admin.pages.dashboard.';
        $this->controllerName     = 'dashboard';
        parent::__construct();
    }

    public function index(Request $request)
    {
        $countUser = $this->model->countItems(['task' => 'user']);
        $countArticle = $this->model->countItems(['task' => 'article']);
        $countCategory = $this->model->countItems(['task' => 'category']);
        $countSlider = $this->model->countItems(['task' => 'slider']);

        return view($this->pathViewController .  'index', [
            'items' => [
                'countUser' => $countUser,
                'countArticle' => $countArticle,
                'countCategory' => $countCategory,
                'countSlider' => $countSlider
            ]
        ]);
    }
}
