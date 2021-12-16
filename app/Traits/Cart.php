<?php
namespace App\Traits;

use App\Models\Clothe;

trait Cart {

    public function add(int $numero)
    {
        $clothe = Clothe::find($numero);
        if (is_null($clothe)) { return; }
        $price = $clothe->is_sale ? $clothe->sale : $clothe->price;
        $items_ses = session()->get('items');
        if (!is_null($items_ses) && $items_ses->isNotEmpty()) {
            if (!$items_ses->contains('numero', $numero)) {
                $items_ses->push([
                    "numero" => $clothe->id,
                    "name" => $clothe->name,
                    "price" => $price,
                    "count" => 1,
                    "priceTotal" => $price,
                    "slug" => $clothe->slug,
                ]);
                $this->save($items_ses);
            }
        } else {
            $items = collect([]);
            $items->push([
                "numero" => $clothe->id,
                "name" => $clothe->name,
                "price" => $price,
                "count" => 1,
                "priceTotal" => $price,
                "slug" => $clothe->slug,
            ]);
            $this->save($items);
        }
    }

    public function plus(int $numero)
    {
        $items_ses = session()->get('items');
        if ($items_ses->contains('numero', $numero)) {
            $items = $items_ses->map(function ($item, $value) use ($numero) {
                if ($item['numero'] === $numero) {
                    $item['count'] += 1;
                    $item['priceTotal'] = $item['price'] * $item['count'];
                }
                return $item;
            });

            $this->save($items);
        }
    }

    public function minus(int $numero)
    {
        $items_ses = session()->get('items');
        if ($items_ses->contains('numero', $numero)) {
            $items = $items_ses->map(function ($item, $value) use ($numero) {
                if ($item['numero'] === $numero) {
                    $item['count'] -= 1;
                    $item['priceTotal'] = $item['price'] * $item['count'];
                }
                return $item;
            })->reject(fn ($value, $key) => $value['count'] === 0);

            $this->save($items);
        }
    }

    public function remove(int $index)
    {
        $items_ses = session()->get('items');
        if ($items_ses->contains('numero', $numero)) {
            $items = $items_ses->reject(fn ($value, $key) => $value['count'] === $numero);

            $this->save($items);
        }
    }

    private function save($items)
    {
        $count = $items->sum('count');
        $countTotal = $items->sum('priceTotal');

        // remove session previeus
        if (session()->has('items')) {
            session()->forget('items');
        }
        if (session()->has('count')) {
            session()->forget('count');
        }
        if (session()->has('countTotal')) {
            session()->forget('countTotal');
        }

        // store sesion
        session()->put('items', $items);
        session()->put('count', $count);
        session()->put('countTotal', $countTotal);
    }

}