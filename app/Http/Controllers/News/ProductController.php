<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OrderConfirm;
use App\Http\Requests\OrderRequest as MainRequest;

use App\Models\ProductModel;
use App\Models\SettingModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    private $pathViewController = 'news.pages.product.';
    private $controllerName     = 'product';
    private $model;
    private $settingModel;
    private $title              = 'Săn Voucher';
    public function __construct()
    {
        $this->model = new ProductModel();
        $this->settingModel = new SettingModel();
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {   
        $params['pagination']['totalItemsPerPage'] = 9;
        $itemsProduct = $this->model->listItems($params, ['task' => 'news-list-items']);
        return view($this->pathViewController . 'index', [
            'title' => $this->title,
            'itemsProduct' => $itemsProduct,
        ]);
    }

    public function addCart(Request $request) {
        $params['id'] = $request->id;
        $cart = $this->model->cart($params, ['task' => 'add-cart']);
        if(isset($cart)) $request->session()->put('cart', true);
        return response()->json([
            'data' => $cart
        ]);
    }

    public function cart(Request $request) {
        $title = 'Giỏ hàng';
        $cartDetail = $this->model->cart(null, ['task' => 'get-cart-detail']);

        return view($this->pathViewController . 'cart.index', compact('title', 'cartDetail'));
    }

    public function deleteCartItem(Request $request) {
        $params['id'] = $request->id;
        $notify = 'Xóa thành công sản phẩm';
        $this->model->cart($params, ['task' => 'delete-cart-item']);
        return redirect()->route("$this->controllerName/cart")->with("zvn_notify", $notify);;
    }

    public function changeQtyCart(Request $request) {
        $params['id'] = $request->id;
        $params['qty'] = $request->quantity;

        $this->model->cart($params, ['task' => 'change-qty-cart']);
        return response()->json([
            'data' => $params
        ]);
    }

    public function checkOut(Request $request) {
        $title = 'Thanh toán';
        $cartDetail = $this->model->cart(null, ['task' => 'get-cart-detail']);
        return view($this->pathViewController . 'cart.checkout.index', compact('title', 'cartDetail'));
    }

    public function order(MainRequest $request) {
        $params['name'] = $request->name;
        $params['phone'] = $request->phone;
        $params['email'] = $request->email;
        $params['MaHD'] = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
        $result = $this->model->cart($params, ['task' => 'order']);
        
        if(!empty($result)) {
            $bank_setting = $this->settingModel->getItem(['field' => 'key_value', 'field_value' => 'bank-setting'], ['task' => 'get-item']);
            $order = [
                'MaHD'  => $params['MaHD'],
                'total' => $result['total'],
                'deadline_payment' => $result['deadline_payment']
            ];
            Mail::to($request->email)->send(new OrderConfirm($order, $bank_setting));
        }

        return response()->json([
            'status' => 200,
            'data'   => $params
        ]);
    }

    public function thank(Request $request) {
        if ($request->session()->has('cart')) $request->session()->pull('cart');
        return view($this->pathViewController . 'cart.checkout.thank_you_page');
    }
}