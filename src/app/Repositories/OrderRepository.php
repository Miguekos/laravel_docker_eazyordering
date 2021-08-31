<?php

namespace App\Repositories;

use Auth;
use App\Models\Order;

class OrderRepository
{	
    private $order;

    public function __construct(
        Order $order
    )
    {
        $this->order = $order;
    }

    public function getById($id){

        $order = $this->order->where('id', $id)->first();

        return $order;
    }

    public function all($perPage){

        if (Auth::user()->isAdmin()) {
            $orders = $this->order->paginate($perPage);
        }
        else if(Auth::user()->isWarehouse()){
            $orders = $this->order->where('warehouse_id', Auth::id())->paginate($perPage);
        }
        else if(Auth::user()->isManager()){        
            $orders = $this->order->where('manager_id', Auth::id())->paginate($perPage);
        }

        return $orders;
    }

}