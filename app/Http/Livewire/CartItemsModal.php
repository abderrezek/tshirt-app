<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;

class CartItemsModal extends Component
{
    public $isPanier;
    public $isClothe;
    protected $listeners = ['cart_items_modal_update' => 'render'];

    public function mount(bool $isPanier, bool $isClothe)
    {
        $this->isPanier = $isPanier;
        $this->isClothe = $isClothe;
    }

    public function plus(int $id, Request $request)
    {
        $cart = Cart::content()->where('id', $id);
        if ($cart->count()) {
            $cart = $cart->first();
            $qty = $cart->qty + 1;
            Cart::update($cart->rowId, $qty);
            $this->emit('cart_counter_update');
            $this->emit('cart_main_update');
            if ($isPanier) {
                $this->emit('cart_panier_update');
            }
            if ($isClothe) {
                $this->emit('cart_clothe_update');
            }
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
            $this->emit('cart_main_update');
            if ($isPanier) {
                $this->emit('cart_panier_update');
            }
            if ($isClothe) {
                $this->emit('cart_clothe_update');
            }
        }
    }

    public function remove(int $id)
    {
        $cart = Cart::content()->where('id', $id);
        if ($cart->count()) {
            $cart = $cart->first();
            Cart::remove($cart->rowId);

            $this->emit('cart_counter_update');
            $this->emit('cart_main_update');
            if ($isPanier) {
                $this->emit('cart_panier_update');
            }
            if ($isClothe) {
                $this->emit('cart_clothe_update');
            }
        }
    }

    public function removeAll()
    {
        Cart::destroy();
        $this->emit('cart_counter_update');
        $this->emit('cart_main_update');
        if ($isPanier) {
            $this->emit('cart_panier_update');
        }
        if ($isClothe) {
            $this->emit('cart_clothe_update');
        }
    }

    public function render()
    {
        $cart = Cart::content();
        $total = Cart::priceTotal();

        return view('livewire.cart-items-modal', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }
}
