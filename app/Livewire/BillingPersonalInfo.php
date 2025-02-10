<?php

namespace App\Livewire;

use App\Models\Billing;
use App\Models\user\User;
use Livewire\Component;

class BillingPersonalInfo extends Component
{
    public $user;
    public $id;
    public $text;
    public $icon;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function storePersonalInfo()
    {
        $name = $this->user->firstname . ' ' . $this->user->lastname;
        $billing = Billing::where('user_id', $this->user->id)
            ->where('status', 0)
            ->first();

        if (!$billing) {
            $newBilling = new Billing();
            $newBilling->user_id = $this->user->id;
            $newBilling->name = $name;
            $newBilling->phone = $this->user->phone;
            $newBilling->nif = $this->user->nif;
            $newBilling->email = $this->user->email;
            $newBilling->status = 0;
            $newBilling->save();
        }
        else{
            $billing->name = $name;
            $billing->phone = $this->user->phone;
            $billing->nif = $this->user->nif;
            $billing->email = $this->user->email;
            $billing->save();
        }

        return redirect()->route('payment-methods');
    }

    public function render()
    {
        return view('livewire.billing-personal-info');
    }
}
