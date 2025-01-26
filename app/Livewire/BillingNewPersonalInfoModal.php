<?php

namespace App\Livewire;

use App\Http\Requests\BillingRequest;
use App\Http\Requests\user\UserRequest;
use App\Models\Billing;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BillingNewPersonalInfoModal extends Component
{
    public $modalIdName;
    public $user;

    public $nif;
    public $name;
    public $email;
    public $phone;

    public function submit()
    {
        $billingRequest = new BillingRequest();
        $rules = $billingRequest->rulesFor('personal-info');
        $messages = $billingRequest->messages();

        $this->validate($rules, $messages);

        $user_id = $this->user->id;

        Billing::updateOrCreate(['user_id' => $user_id], [
            'name' => $this->name,
            'nif' => $this->nif,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Billing information submitted successfully.');
        $this->redirectRoute('payment-methods');
        $this->reset();
    }


    public function render()
    {
        return view('livewire.billing-new-personal-info-modal');
    }
}
