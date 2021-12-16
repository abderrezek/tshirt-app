<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Livewire\Component;

class InfoPhoneAddress extends Component
{
    public $phone;
    public $wilaya;
    public $commune;
    public $address;
    public $wilayas = [];
    public $communes = [];

    protected $rules = [
        'phone' => 'required|digits:10',
        'wilaya' => 'required',
        'commune' => 'required_with:wilaya',
        'address' => 'required|string|min:5|max:255',
    ];

    public function mount(Request $request)
    {
        $wilayas = Wilaya::all(['name'])->map(fn ($item, $key) => $item['name'])->toArray();
        $this->wilayas = $wilayas;
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
        $user->phone = $this->phone;
        $user->wilaya = $this->wilaya;
        $user->commune = $this->commune;
        $user->address = $this->address;
        $user->save();

        return redirect()->route('site.boutique');
    }

    public function render()
    {
        return view('livewire.info-phone-address');
    }
}
