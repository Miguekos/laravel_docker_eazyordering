<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;

class ProductList extends Component
{
    private $user;
    private $product;

    public $category;
    public $warehouse_id;

    public function __construct(
        ProductRepository $product,
        UserRepository $user
    )
    {
        $this->product = $product;
        $this->user = $user;
    }


    public function mount($category, $warehouse_id)
    {
        $this->category = $category;
        $this->warehouse_id = $warehouse_id;
    }

    public function render()
    {        
        //$products = $this->product->available();
        $warehouse = $this->user->getById($this->warehouse_id);
        $products = $this->product->getByCategoryAndWarehouse($this->category, $this->warehouse_id);

        return view('livewire.product-list', [
            'products' => $products,
            'category'=> $this->category,
            'warehouse'=> $warehouse
        ]);
    }
}
