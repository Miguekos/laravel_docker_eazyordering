<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;

class Category extends Component
{
    private $product;
    private $user;

    public function __construct(
        ProductRepository $product,
        UserRepository $user
    )
    {
        $this->product = $product;
        $this->user = $user;
    }

    public function mount($warehouse_id)
    {
        $this->warehouse_id = $warehouse_id;
    }

    public function render()
    {
        $warehouse = $this->user->getById($this->warehouse_id);
        $categories = $this->product->getCategoriesByWarehouse($this->warehouse_id);

        foreach ($categories as $category) {
            $category->img = 'images/categories/'.$category->category.'.png';
        }

        return view('livewire.category', [
            'categories' => $categories,
            'warehouse' => $warehouse
        ]);
    }
}
