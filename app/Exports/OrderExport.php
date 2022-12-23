<?php

namespace App\Exports;

use App\Models\OrderModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('exports.order', [
            'orders' => OrderModel::all()
        ]);
    }
}
