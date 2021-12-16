<?php

namespace App\Http\Livewire;

use App\Models\Clothe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Clothes extends Component
{
    public $items = 8;
    public $filter;
    private $filters = ['créé', 'prix', 'nom', 'nombre_acheter'];
    private $filter_db;
    private $filters_db = ['created_at', 'price', 'name', 'nb_added'];

    protected $listeners = ['cart_main_update' => 'render'];

    public function mount()
    {
        $this->filter = 'créé';
        $this->filter_db = 'created_at';
    }

    public function load()
    {
        $this->items += 4;
    }

    public function filter()
    {
        if (!in_array($this->filter, $this->filters)) {
            $this->filter = $this->filters[0];
        }
    }

    public function addToCart(int $clothe_id)
    {
        $clothe = Clothe::findOrFail($clothe_id);

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
        for ($i = 0; $i < count($this->filters); $i++) {
            if ($this->filter === $this->filters[$i]) {
                $this->filter_db = $this->filters_db[$i];
            }
        }
        // $clothes = Clothe::where('is_enabled', true)
        //                 ->orderByDesc($this->filter_db)
        //                 ->take($this->items)
        //                 ->get();

        $clothes = Clothe::withCount('images')
                    ->where('is_enabled', true)
                    ->orderByDesc($this->filter_db)
                    ->take($this->items)
                    ->get();
        $count_clothes = Clothe::count();

        $cart = Cart::content();

        return view('livewire.clothes', [
            'clothes' => $clothes,
            'count_clothes' => $count_clothes,
            'cart' => $cart,
        ]);
    }
}
