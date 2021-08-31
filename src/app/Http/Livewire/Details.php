<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\ProductRepository;

class Details extends Component
{
    private $product;
    public $product_id;

    public function __construct(
        ProductRepository $product
    )
    {
        $this->product = $product;
    }


    public function mount($product_id)
    {
        $this->product_id = $product_id;
    }

    public function render()
    {
        $product = $this->product->getById($this->product_id);
        
        return view('livewire.details', [
            'product' => $product
        ]);
    }
}
