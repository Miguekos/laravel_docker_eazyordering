<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Order as OrderModel;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Order extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $queryString = [
        'search' => ['except' => ''], 
        'perPage'  => ['except' => 5], 
    ];
    
    
    public $search = '';
    public $perPage = 5;
  
    public function render()
    {       
        if (Auth::user()->isAdmin()) {
            $orders = OrderModel::paginate($this->perPage);
        }
        else if(Auth::user()->isWarehouse()){
            $orders = OrderModel::where('warehouse_id', Auth::id())->paginate($this->perPage);
        }
        else if(Auth::user()->isManager()){        
            $orders = OrderModel::where('manager_id', Auth::id())->paginate($this->perPage);
        }

        return view('livewire.order', [
            'orders' => $orders
        ]);
    }
}
