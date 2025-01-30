<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePaymentMethodModal extends Component
{
    public $modalIdName;

    public function render()
    {
        return view('livewire.create-payment-method-modal');
    }
}
