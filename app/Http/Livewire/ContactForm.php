<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;

    public $success = false;
    public $open = false;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|regex:/^0[5-7][0-9]{8}$/',
        'message' => 'required|string|min:5',
    ];

    public function submit()
    {
        $this->validate();
        $this->open = true;
    }
    public function checked()
    {
        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);
        $this->open = false;
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
