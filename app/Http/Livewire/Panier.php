<?php

namespace App\Http\Livewire;

use Gabievi\Promocodes\Facades\Promocodes;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;

class Panier extends Component
{
    public $errEmpty = false;

    public $codeEmpty = false;
    public $msgCodeEmpty = '';
    public $codeIncorrect = false;
    public $msgCodeIncorrect = '';
    public $code;
    public $remarque;
    public $address;
    public $isDiscounted = false;
    public $discountPrix = 0;
    public $search;

    protected $queryString = ['search'];

    protected $listeners = ['cart_panier_update' => 'render'];

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

    public function remove(int $id)
    {
        $cart = Cart::content()->where('id', $id);
        if ($cart->count()) {
            $cart = $cart->first();
            Cart::remove($cart->rowId);

            $this->emit('cart_counter_update');
            $this->emit('cart_items_modal_update');
        }
    }

    public function removeAll()
    {
        Cart::destroy();
        $this->emit('cart_counter_update');
        $this->emit('cart_items_modal_update');
    }

    public function applyCode()
    {
        if ($this->code === '') {
            $this->codeEmpty = true;
            $this->msgCodeEmpty = 'Coupon is empty';
            return;
        }
        $this->codeEmpty = false;
        $promocode = Promocodes::check($this->code);
        if (!$promocode) {
            $this->codeIncorrect = true;
            $this->msgCodeIncorrect = 'Coupon is incorrect';
            return;
        }
        $this->codeIncorrect = false;

        $priceTotal = Cart::priceTotal();
        Cart::setGlobalDiscount($promocode->reward);
        $discount = Cart::discount();
        $total = Cart::subTotal();
        $this->discountPrix = $total;
        $this->isDiscounted = true;
    }

    public function submit()
    {
        $cart = Cart::count();
        if ($cart === 0) {
            $this->errEmpty = true;
            return;
        }
        $this->errEmpty = false;

        if ($this->address != '') {
            session()->put('address', $this->address);
        }

        if ($this->remarque != '') {
            session()->put('remarque', $this->remarque);
        }

        if ($this->code != '') {
            session()->put('code', $this->code);
        }
        return redirect()->route('site.checkout');
    }

    public function render()
    {
        $cart = Cart::content();
        $isEmpty = $cart->isEmpty();
        if ($this->search != '') {
            $cart = $cart->filter(function ($item, $key) {
                return false !== stristr($item->name, $this->search);
            });
        }
        $total = Cart::priceTotal();

        return view('livewire.panier', [
            'cart' => $cart,
            'total' => $total,
            'isEmpty' => $isEmpty,
        ]);
    }
}
