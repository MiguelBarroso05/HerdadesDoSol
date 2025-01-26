<?php

namespace App\Livewire;

use App\Models\Billing;
use Livewire\Component;

class EditBillingInfoModal extends Component
{
    public $userBillingInfo;
    public function mount(){
        $this->userBillingInfo = Billing::where('user_id', auth()->id())->first();
    }

    public function render()
    {
        return view('livewire.edit-billing-info-modal');
    }
}
