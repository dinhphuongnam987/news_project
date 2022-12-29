<?php

use Illuminate\Support\Facades\Route;

$prefixAdmin = config('zvn.url.prefix_admin');

Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin', 'middleware' => ['permission.admin']], function () {
    // ============================== DASHBOARD ==============================
    $prefix         = 'dashboard';
    $controllerName = 'dashboard';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    });

    // ============================== MENU ==============================
    $prefix         = 'menu';
    $controllerName = 'menu';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-type-menu-{type_menu}/{id}',     ['as' => $controllerName . '/type_menu',     'uses' => $controller . 'typeMenu']);
        Route::get('change-type-open-menu-{type_open_menu}/{id}',     ['as' => $controllerName . '/type_open_menu',     'uses' => $controller . 'typeOpenMenu']);
        Route::get('change-ordering-{ordering}/{id}',   ['as' => $controllerName . '/ordering',      'uses' => $controller . 'ordering'])->where('id', '[0-9]+');
    });

    // ============================== SLIDER ==============================
    $prefix         = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-ordering-{ordering}/{id}',   ['as' => $controllerName . '/ordering',      'uses' => $controller . 'ordering'])->where('id', '[0-9]+');
    });

    // ============================== CATEGORY ==============================
    $prefix         = 'category';
    $controllerName = 'category';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-is-home-{is_home}/{id}',      ['as' => $controllerName . '/isHome',      'uses' => $controller . 'isHome'])->where('id', '[0-9]+');
        Route::get('change-display-{display}/{id}',     ['as' => $controllerName . '/display',     'uses' => $controller . 'display']);
        Route::get('move-{type}/{id}',                  ['as' => $controllerName . '/move',     'uses' => $controller . 'move']);
    });

    // ============================== ARTICLE ==============================
    $prefix         = 'article';
    $controllerName = 'article';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
        Route::get('change-type-{type}/{id}',           ['as' => $controllerName . '/type',        'uses' => $controller . 'type']);
        Route::get('change-category-{category_id}/{id}',              ['as' => $controllerName . '/category',     'uses' => $controller . 'category']);
    });

    // ============================== PRODUCT ==============================
    $prefix         = 'product';
    $controllerName = 'product';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
        Route::post('import',                           ['as' => $controllerName . '/import',      'uses' => $controller . 'import']);
    });

    // ============================== ORDER ==============================
    $prefix         = 'order';
    $controllerName = 'order';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status_payment}/{id}',       ['as' => $controllerName . '/status_payment',      'uses' => $controller . 'statusPayment']);
        Route::get('bill-detail-{MaHD}',       ['as' => $controllerName . '/bill-detail',      'uses' => $controller . 'billDetail']);
        Route::get('export',       ['as' => $controllerName . '/export',      'uses' => $controller . 'export']);
    });

    // ============================== USER ==============================
    $prefix         = 'user';
    $controllerName = 'user';
    Route::group(['prefix' =>  $prefix, 'middleware' => 'permission.founder'], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::post('change-password',                  ['as' => $controllerName . '/change-password',        'uses' => $controller . 'changePassword']);
        Route::post('change-level',                     ['as' => $controllerName . '/change-level',        'uses' => $controller . 'changeLevel']);
        Route::post('change-permission',                 ['as' => $controllerName . '/change-permission',      'uses' => $controller . 'changePermission']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
        Route::get('change-level-{level}/{id}',         ['as' => $controllerName . '/level',      'uses' => $controller . 'level']);
    });

    // ============================== USER GROUP ==============================
    $prefix         = 'user-group';
    $controllerName = 'userGroup';
    Route::group(['prefix' =>  $prefix, 'middleware' => 'permission.founder'], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    });

    // ============================== RSS ==============================
    $prefix         = 'rss';
    $controllerName = 'rss';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-ordering-{ordering}/{id}',   ['as' => $controllerName . '/ordering',      'uses' => $controller . 'ordering'])->where('id', '[0-9]+');
    });

    // ============================== CHANGE PASSWORD ==============================
    $prefix         = 'password';
    $controllerName = 'password';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/', ['as' => $controllerName, 'uses' => $controller . 'form']);
        Route::post('change-password', ['as' => $controllerName . '/change-password', 'uses' => $controller . 'changePassword']);
    });

    // ====================== GALLERY ========================
    $prefix         = '';
    $controllerName = 'gallery';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/gallery',                             ['as' => "$controllerName",                  'uses' => $controller . 'index']);
    });

    // ====================== SETTING ========================
    $prefix         = 'setting';
    $controllerName = 'setting';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/{key?}',      ['as' => $controllerName, 'uses' => $controller . 'index']);
        Route::post('save', ['as' => $controllerName . '/save', 'uses' => $controller . 'save']);
    });

    // ====================== SETTING ========================
    $prefix         = 'contact';
    $controllerName = 'contact';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('',      ['as' => $controllerName, 'uses' => $controller . 'index']);
        Route::get('change-status-{status}/{id}', ['as' => $controllerName . '/status', 'uses' => $controller . 'status']);
        Route::get('delete/{id}', ['as' => $controllerName . '/delete', 'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    });

    // ====================== LOG VIEWER ========================
    $prefix         = 'log-viewer';
    Route::group(['prefix' =>  $prefix], function () {
        Route::get('', function() {
            return view('admin.pages.log.index');
        })->name('log-viewer');
    });
});