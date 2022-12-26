<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderCanceled;
use Illuminate\Support\Facades\Mail;

class OrderModel extends AdminModel
{
    protected $fillable = ['name', 'email', 'phone', 'MaHD', 'status'];
    public function __construct()
    {
        $this->table               = 'order';
        $this->fieldSearchAccepted = ['name', 'description', 'code', 'MaHD'];
    }

    public function listItems($params = null, $options = null) {
        // update quantity product if time now bigger than time deadline_payment
        $this->updateStatusDeadlinePayment();

        $result = null;
        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'name', 'email', 'phone', 'MaHD', 'status', 'created_at', 'deadline_payment');

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
            $result = self::select('id', 'name', 'email', 'phone', 'MaHD')->where('id', $params['id'])->first()->toArray();
        }

        if ($options['task'] == 'get-bill-detail') {
            $result = self::select('order.name', 'order.email', 'order.phone', 'order.status', 
                                   'order.MaHD', 'order.created_at', 'billing_detail.quantity', 'product.name as sp', 'product.price')
                            ->join('billing_detail', 'order.MaHD', '=', 'billing_detail.MaHD')
                            ->join('product', 'billing_detail.product_id', '=', 'product.id')
                            ->where('order.MaHD',  $params['MaHD'])
                            ->get()->toArray();
        }

        return $result;
    }

    public function updateStatusDeadlinePayment() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $orders = $this->select('id', 'status', 'deadline_payment', 'email', 'MaHD')->get()->toArray();
        foreach($orders as $val) {
            $currentStatus = $val['status'];
            if($currentStatus == 'pending_payment')  {
                $timeNow = strtotime(date("Y-m-d H:i:s"));
                $timeDeadlinePayment = strtotime($val['deadline_payment']);
                if($timeNow > $timeDeadlinePayment) {
                    $this->saveItem(
                        ['id' => $val['id'], 'currentstatusPayment' => 'unpaid'], 
                        ['task' => 'change-status-payment']
                    );
                    $message = (new OrderCanceled($val['MaHD']))->onQueue('order-canceled-email');
                    Mail::to($val['email'])->queue($message);
                }
            }
        }
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status-payment') {
            $statusPayment = $params['currentstatusPayment'];
            self::where('id', $params['id'])->update(['status' => $statusPayment]);
            $this->updateQtyRemaining($params);
        }

        if ($options['task'] == 'edit-item') {
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function updateQtyRemaining($params) {
        $MaHD = $this->select('MaHD')->where('id', $params['id'])->first()->toArray();
        $result = $this->select('billing_detail.quantity as qty_order', 'product.quantity as qty_product', 'product.quantity_remaining', 'product.id')
        ->join('billing_detail', 'order.MaHD', '=', 'billing_detail.MaHD')
        ->join('product', 'billing_detail.product_id', '=', 'product.id')
        ->where('order.MaHD', $MaHD['MaHD'])
        ->get()->toArray();

        foreach($result as $val) {
            if($params['currentstatusPayment'] == 'unpaid') {
                $qty_remaining = $val['quantity_remaining'] + $val['qty_order'];
                DB::table('product')->where('id', $val['id'])->update(['quantity_remaining' => $qty_remaining]);
            }
        }
    }

    public function deleteItem($params = null, $options = null) 
    {
        if($options['task'] == 'delete-item') {
            $order = self::select('status')->where('id', $params['id'])->first()->toArray();
            if($order['status'] == 'unpaid') {
                self::where('id', $params['id'])->delete();
                return true;
            }
            return false;
        }
    }
}
