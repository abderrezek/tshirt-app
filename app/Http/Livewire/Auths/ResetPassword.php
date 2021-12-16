<?php

namespace App\Http\Livewire\Auths;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    public $status = '';
    // public $class = 'danger';

    public $rules = [
        'token' => 'required',
        'email' => 'required|string|email',
        'password' => 'required|confirmed',
    ];

    public function submit()
    {
        $this->validate();

        $this->status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($this->status === Password::PASSWORD_RESET) {
            session()->flash('status', __($this->status));
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.auths.reset-password');
    }
}
