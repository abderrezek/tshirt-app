<?php

namespace App\Http\Livewire;

use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class InfoPersonnelle extends Component
{
    public $name;
    public $email;
    public $phone;
    public $current_password;
    public $password;
    public $password_confirmation;

    public $status = '';
    public $class = '';

    protected function rules()
    {
        $user = auth()->user();
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => [
                'digits:10',
            ],
            'current_password' => [
                'nullable',
                'required_with:password',
                new MatchOldPassword,
            ],
            'password' => [
                'nullable',
                'required_with:current_password',
                'confirmed',
                'min:8',
            ],
        ];
    }

    public function mount(Request $request)
    {
        $user = $request->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function submit(Request $request)
    {
        $this->validate();

        $user = $request->user();

        if ($this->password !== null) {
            $user->password = Hash::make($this->password);
        }

        $user->name = $this->name;
        $user->email = $this->email;

        if ($user->save()) {
            $this->status = 'update.success';
        } else {
            $this->status = 'update.error';
        }

        if ($this->status === 'update.success') {
            $this->class = 'success';
        } else {
            $this->class = 'danger';
        }
    }

    public function render()
    {
        return view('livewire.info-personnelle');
    }
}
