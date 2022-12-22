<?php

namespace App\Exports;

use App\Models\OrderModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView
{
    public function view(): View
    {
        return view('exports.order', [
            'orders' => OrderModel::all()
        ]);
    }
}
