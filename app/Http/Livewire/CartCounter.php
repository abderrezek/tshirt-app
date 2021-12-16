<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart_counter_update' => 'render'];

    public function render()
    {
        $cart_counter = Cart::count();

        return view('livewire.cart-counter', [
            'cart_counter' => $cart_counter,
        ]);
    }
}
