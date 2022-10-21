<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

// ============================== 404 ERROR PAGE ==============================
Route::get('404', ['as' => '404', 'uses' => function () {
    return view('errors.404');
}]);

Route::prefix('/')->group(function() {
    require base_path('routes/web/admin.php');
    require base_path('routes/web/news.php');
});
