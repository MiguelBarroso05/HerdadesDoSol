<?php

namespace App\Livewire;

use App\Models\Billing;
use App\Models\user\Address;
use App\Models\user\User;
use Livewire\Component;

class BillingAddressInfo extends Component
{
    public $user;
    public $id;
    public $text;
    public $icon;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function storeAddressInfo()
    {
        $addressId = $this->user->addresses()->first()->id;

        Billing::updateOrCreate(['user_id' => $this->user->id], [
            'address_id' => $addressId,
        ]);


        return redirect()->route('payment-methods');
    }

    public function render()
    {
        return view('livewire.billing-address-info');
    }
}
