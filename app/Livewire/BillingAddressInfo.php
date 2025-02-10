<?php

namespace App\Livewire;

use App\Models\Billing;
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

        $billing = Billing::where('user_id', $this->user->id)
            ->where('status', 0)
            ->first();

        if (!$billing) {
            $newBilling = new Billing();
            $newBilling->address_id = $addressId;
            $newBilling->save();
        }
        else{
            $billing->address_id = $addressId;
            $billing->save();
        }

        return redirect()->route('payment-methods');
    }

    public function render()
    {
        return view('livewire.billing-address-info');
    }
}
