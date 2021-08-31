<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    public $order_id;

    public function __construct($order_id){
        $this->order_id = $order_id;

    }

    public function view(): View
    {
    	$order = Order::findOrFail($this->order_id);
    	
        return view('exports.orders', [
            'order' => $order
        ]);
    }
}