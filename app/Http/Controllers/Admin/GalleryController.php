<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;


class GalleryController extends AdminController
{
    protected $model;

    public function __construct()
    {
        $this->pathViewController = 'admin.pages.gallery.';
    }

    public function index(Request $request)
    {
        return view($this->pathViewController . '/index');
    }
}
