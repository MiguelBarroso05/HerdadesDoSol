<?php

namespace App\Livewire;

use App\Models\Billing;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $total;
    public $selectedCard;
    public $isReservation;
    public $billingInformation;
    public $billingAddress;
    public $address;

    public function mount()
    {
        $this->total = 0;
        $this->selectedCard = auth()->user()->paymentMethods->firstWhere('predefined', 1);
        $this->billingInformation = Billing::where('user_id', auth()->id())->first();
        $this->billingAddress = $this->billingInformation->address;
        $this->address = auth()->user()->addresses->where('isFavorite', 1)->first() ??  auth()->user()->addresses->first();
    }
    public function render()
    {
        return view('livewire.checkout-component');
    }
    public function updated(){
        
    }
}
