<?php

namespace App\Livewire;

use App\Models\Billing;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class PaymentMethodPage extends Component
{
    public $userBillingInfo;
    public $selectedCard = null;
    public $paymentMethods;

    public function mount(){
        $this->userBillingInfo = Billing::where('user_id', auth()->id())->first();
        $this->paymentMethods = auth()->user()->paymentMethods()->get();

        if ($this->userBillingInfo && $this->userBillingInfo->address_id) {
            $this->userBillingInfo->load('address');
        }
    }

    public function selectCard($cardId)
    {
        $this->selectedCard = $this->paymentMethods->find($cardId);
    }

    public function PredefinedCard($selectedCard)
    {

        $currentPredefinedCardId = auth()->user()->paymentMethods()->where('predefined', true)->first()?->id;

        if ($currentPredefinedCardId == $selectedCard) {
            auth()->user()->paymentMethods()->where('id', $currentPredefinedCardId)->update(['predefined' => false]);
        } else {

            auth()->user()->paymentMethods()->where('id', $currentPredefinedCardId)->update(['predefined' => false]);
            auth()->user()->paymentMethods()->where('id', $selectedCard)->update(['predefined' => true]);
        }

        $this->paymentMethods = auth()->user()->fresh()->paymentMethods()->get();
    }

    public function deleteCard($cardId){
        $this->paymentMethods->find($cardId)->delete();
        return redirect()->route('payment-methods');
    }

    public function render()
    {
        return view('livewire.payment-method-page', [
            'userBillingInfo' => $this->userBillingInfo
        ]);
    }
}
