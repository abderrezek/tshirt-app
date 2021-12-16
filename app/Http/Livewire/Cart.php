<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart as CartShopping;
use Livewire\Component;

class Cart extends Component
{
    public $isPanier;
    public $isClothe;

    public function mount(bool $isPanier, bool $isClothe)
    {
        $this->isPanier = $isPanier;
        $this->isClothe = $isClothe;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
