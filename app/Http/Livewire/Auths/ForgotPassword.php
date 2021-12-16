<?php

namespace App\Http\Livewire\Auths;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $isForgotPassword;

    public $email;
    public $status = '';
    public $class = 'danger';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function submit()
    {
        $this->validate();

        $this->status = Password::sendResetLink([
            'email' => $this->email,
        ]);
        if ($this->status === 'passwords.sent') {
            $this->class = 'success';
        } else {
            $this->class = 'danger';
        }
    }

    public function render()
    {
        return view('livewire.auths.forgot-password');
    }
}
