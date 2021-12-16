<?php

namespace App\Http\Livewire;

use Gabievi\Promocodes\Facades\Promocodes;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;

class Checkout extends Component
{
    protected $listeners = ['result'];

    public function result(string $type, Request $request)
    {
        if ($type == 'yes') {
            // save all data in orders & clothes_orders
            $session = $request->session();
            $code = $session->pull('code', null);
            if (!is_null($code) && Promocodes::check($code)) {
                $promocode = Promocodes::redeem($code);
                $session->push('promo.code', $code);
                $session->push('promo.reward', $promocode->reward);
                $session->push('promo.discount', Cart::discount());
                $session->push('promo.total', Cart::subTotal());
            }
            $remarque = $session->get('remarque');
            $address = $session->get('address');
            $cart = Cart::content();
            $priceTotal = Cart::priceTotal();

            dd('yes', $session->get('promo'), $cart, $priceTotal, $address, $remarque);
            return;
        }
        dd('no');
    }

    public function payant()
    {
        $this->dispatchBrowserEvent('confirm-checkout', [
            'title' => 'Voulez-vous enregistrer la commande ?',
            'confirmButtonText' => 'Oui',
            'denyButtonText' => 'Non',

            'msgYes' => 'Votre demande a été enregistrée',
            'msgNo' => 'Votre demande n\'a pas été enregistrée',
        ]);
    }

    public function render(Request $request)
    {
        $session = $request->session();
        $code = $session->pull('code', null);
        if (!is_null($code) && Promocodes::check($code)) {
            $promocode = Promocodes::redeem($code);
            $session->push('promo.code', $code);
            $session->push('promo.reward', $promocode->reward);
            $session->push('promo.discount', Cart::discount());
            $session->push('promo.total', Cart::subTotal());
        }
        $remarque = $session->get('remarque');
        $address = $session->get('address');
        $cart = Cart::content();
        $priceTotal = Cart::priceTotal();

        return view('livewire.checkout', [
            'promo' => $session->get('promo'),
            'remarque' => $remarque,
            'address' => $address,
            'cart' => $cart,
            'priceTotal' => $priceTotal,
        ]);
    }
}
