<?php

namespace App\Http\Livewire\Auths;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $isRegister;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|min:3|max:255|unique:users',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|confirmed',
    ];

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect()->route('site.address');
    }

    public function render()
    {
        return view('livewire.auths.register');
    }
}
