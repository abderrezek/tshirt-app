<?php

namespace App\Http\Livewire;

use App\Models\Clothe as ClotheModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Clothe extends Component
{
    public $numero;

    protected $listeners = ['cart_clothe_update' => 'render'];

    public function add(int $id)
    {
        $clothe = ClotheModel::findOrFail($id);

        Cart::add(
            $clothe->id,
            $clothe->name,
            1,
            $clothe->is_sale ? $clothe->sale : $clothe->price,
        );

        $this->emit('cart_counter_update');
        $this->emit('cart_items_modal_update');
    }

    public function plus(int $id)
    {
        $cart = Cart::content()->where('id', $id);
        if ($cart->count()) {
            $cart = $cart->first();
            $qty = $cart->qty + 1;
            Cart::update($cart->rowId, $qty);
            $this->emit('cart_counter_update');
            $this->emit('cart_items_modal_update');
        }
    }

    public function minus(int $id)
    {
        $cart = Cart::content()->where('id', $id);
        if ($cart->count()) {
            $cart = $cart->first();
            $qty = $cart->qty - 1;
            if ($qty <= 0) {
                Cart::remove($cart->rowId);
            } else {
                Cart::update($cart->rowId, $qty);
            }
            $this->emit('cart_counter_update');
            $this->emit('cart_items_modal_update');
        }
    }

    public function render()
    {
        $clothe = Cart::content()->where('id', $this->numero);
        $itemCount = $clothe->count();
        $qty = $itemCount ? $clothe->first()->qty : 0;

        return view('livewire.clothe', [
            'itemCount' => $itemCount,
            'qty' => $qty,
        ]);
    }
}
