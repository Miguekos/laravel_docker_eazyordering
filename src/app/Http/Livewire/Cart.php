<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class Cart extends Component
{
    public function render()
    {
        $cartItems = \Cart::getContent();
        //dd($cartItems);
        
        return view('livewire.cart', [
            'cartItems' => $cartItems
        ]);
    }
}
