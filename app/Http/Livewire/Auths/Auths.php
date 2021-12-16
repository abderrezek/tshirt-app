<?php

namespace App\Http\Livewire\Auths;

use Livewire\Component;

class Auths extends Component
{
    public $types = ["LoginSection", "RegisterSection", "ForgotPasswordSection"];
    public $type = 'LoginSection';

    protected $listeners = ['changeType', 'show'];

    public function changeType($type)
    {
        if (in_array($type, $this->types)) {
            $this->type = $type;
        } else {
            $this->type = $types[0];
        }
    }

    public function render()
    {
        return view('livewire.auths.auths');
    }
}
