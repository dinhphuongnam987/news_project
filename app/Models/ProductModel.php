<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class ProductModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'product';
        $this->folderUpload        = 'product';
        $this->fieldSearchAccepted = ['name', 'description', 'code'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];
    }

    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'name', 'thumb', 'code', 'quantity', 'status', 'price', 'original_price', 'description');

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'thumb', 'code', 'quantity', 'status', 'price', 'original_price', 'description')
                    ->where('status', 'active')
                    ->where('quantity', '>', 0);

            $result =  $query->orderBy('id', 'desc')
            ->paginate($params['pagination']['totalItemsPerPage']);
        }

        return $result;

    }

    public function countItems($params = null, $options  = null)
    {

        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'));

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'thumb', 'code', 'quantity', 'status', 'price', 'original_price', 'description')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'add-item') {
            if(isset($params['thumb'])) $params['thumb']      = $this->uploadThumb($params['thumb']);
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            if (!empty($params['thumb'])) {
                // Xóa hình cũ
                $this->deleteThumb($params['thumb_current']);

                // Up hình mới
                $params['thumb']      = $this->uploadThumb($params['thumb']);
            }

            self::where(['id' => $params['id']])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            $item   = $this->getItem($params, ['task' => 'get-thumb']);
            if(!empty($item)) {
                $this->deleteThumb($item['thumb']);
            }
            self::where('id', $params['id'])->delete();
        }
    }

    public function cart($params = null, $options = null) {
        $time = time() + (86400 * 30);
        if($options['task'] == 'add-cart') {
            $id = $params['id'];
            $cart = null;
            if(empty(request()->cookie('cart'))) {
                $cart[$id] = 1;
                Cookie::queue('cart', json_encode($cart));
            } else {
                $cart = json_decode(request()->cookie('cart'));
                if(property_exists($cart, $id)) {
                    $qty = $cart->$id;
                    $qty += 1;
                    $cart->$id = $qty;
                    Cookie::queue('cart', json_encode($cart), $time);
                } else {
                    $cart->$id = 1;
                    Cookie::queue('cart', json_encode($cart), $time);
                }
            }

            return json_encode($cart);
        }

        if($options['task'] == 'get-cart-detail') {
            if(!empty(request()->cookie('cart'))) {
                $cart = json_decode(request()->cookie('cart'));
                $result = null;
                $total = null;
                foreach($cart as $key => $qty) {
                    $result[$key] = $this->select('id', 'name', 'thumb', 'price', 'quantity as qty_remaining')->where('id', $key)->first()->toArray();
                    $qty = ($qty < $result[$key]['qty_remaining']) ? $qty : $result[$key]['qty_remaining'];
                    $result[$key]['quantity'] = $qty;
                    $result[$key]['sub_total'] = $qty * $result[$key]['price'];
                    $total += $result[$key]['sub_total'];
                    $result[$key]['total'] = $total;
                }

                return $result;
            }
        }

        if ($options['task'] == 'delete-cart-item') {
            $id = $params['id'];
            if(!empty(request()->cookie('cart'))) {
                $cart = json_decode(request()->cookie('cart'));
                unset($cart->$id);
                Cookie::queue('cart', json_encode($cart), $time);
            }
        }

        if ($options['task'] == 'change-qty-cart') {
            $id = $params['id'];
            $qty = $params['qty'];
            if(!empty(request()->cookie('cart'))) {
                $cart = json_decode(request()->cookie('cart'));
                $cart->$id = $qty;
                Cookie::queue('cart', json_encode($cart), $time);
            }
        }

        if($options['task'] == 'order') {
            $params['MaHD'] = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
            $cartDetail = $this->cart(null, ['task' => 'get-cart-detail']);
            DB::table('order')->insert($params);
            foreach($cartDetail as $detail) {
                DB::table('billing_detail')->insert([
                    'MaHD' => $params['MaHD'],
                    'product_id' => $detail['id'],
                    'quantity' => $detail['quantity']
                ]);
                $quantityCurrent = $this->select('quantity')->where('id', $detail['id'])->first()->toArray();
                $quantityRemaining = $quantityCurrent['quantity'] - $detail['quantity'];
                $this->where('id', $detail['id'])->update(['quantity' => $quantityRemaining]);
            }
            if(!empty(request()->cookie('cart'))) {
                Cookie::queue(Cookie::forget('cart'));
            }
        }
    }
}
