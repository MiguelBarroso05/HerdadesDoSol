<?php

namespace App\Livewire;

use Livewire\Component;

class NewAddressBillingModal extends Component
{
    public $modalIdName;
    public $user;

    public function submit(){

    }

    public function render()
    {
        return view('livewire.new-address-billing-modal');
    }
}
