<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.dashboard.';
        $this->controllerName     = 'dashboard';
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view($this->pathViewController .  'index', []);
    }
}
