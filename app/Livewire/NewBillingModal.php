<?php

namespace App\Livewire;

use Livewire\Component;

class NewBillingModal extends Component
{
    public $modalIdName;
    public $user;

    public function submit(){

    }

    public function render()
    {
        return view('livewire.new-billing-modal');
    }
}
