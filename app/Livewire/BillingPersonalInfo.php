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
    public $info;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function storePersonalInfo()
    {
        $name = $this->user->firstname . ' ' . $this->user->lastname;
        Billing::updateOrCreate(['user_id' => $this->user->id], [
            'name' => $name,
            'phone' => $this->user->phone,
            'nif' => $this->user->nif,
            'email' => $this->user->email,
        ]);


        return redirect()->route('payment-methods');
    }

    public function render()
    {
        return view('livewire.billing-personal-info');
    }
}
