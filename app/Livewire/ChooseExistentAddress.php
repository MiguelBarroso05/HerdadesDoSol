<?php

namespace App\Livewire;

use App\Models\Billing;
use Illuminate\Http\Request;
use Livewire\Component;

class ChooseExistentAddress extends Component
{
    public $addresses;
    public $user;
    public $addressId;
    public $addressIdentifier;

    public function mount(){
        $this->addresses = $this->user->addresses;
    }

    public function selectAddress($id)
    {
        $this->addressId = $id;
        $this->addresses = $this->user->fresh()->addresses;
    }

    public function submit(){
        Billing::updateOrCreate(['user_id' => $this->user->id], [
            'address_id' => $this->addressId,
        ]);

        $this->redirectRoute('payment-methods');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.choose-existent-address');
    }
}
