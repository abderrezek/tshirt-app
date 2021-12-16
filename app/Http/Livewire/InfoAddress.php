<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Livewire\Component;

class InfoAddress extends Component
{
    public $wilaya;
    public $commune;
    public $address;
    public $wilayas = [];
    public $communes = [];

    protected $rules = [
        'wilaya' => 'required',
        'commune' => 'required_with:wilaya',
        'address' => 'required|string|min:5|max:255',
    ];

    public function mount(Request $request)
    {
        $wilayas = Wilaya::all(['name'])->map(fn ($item, $key) => $item['name'])->toArray();
        $this->wilayas = $wilayas;

        $user = $request->user();
        if ($user->wilaya !== null) {
            $this->communes = Commune::where('wilaya_id', '=', (int)$user->wilaya)
                                ->get('name')
                                ->map(fn ($item, $key) => $item['name'])
                                ->toArray();
            $this->wilaya = $user->wilaya;
            $this->commune = $user->commune;
            $this->address = $user->address;
        }
    }

    public function change()
    {
        if ($this->wilaya === "aucun") {
            $this->communes = [];
            return;
        }
        $this->communes = Commune::where('wilaya_id', '=', (int)$this->wilaya)
                                ->get('name')
                                ->map(fn ($item, $key) => $item['name'])
                                ->toArray();
    }

    public function submit(Request $request)
    {
        $this->validate();

        $user = $request->user();
        $user->wilaya = $this->wilaya;
        $user->commune = $this->commune;
        $user->address = $this->address;
        $user->save();
    }

    public function render()
    {
        return view('livewire.info-address');
    }
}
