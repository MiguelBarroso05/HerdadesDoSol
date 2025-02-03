<?php

namespace App\Livewire;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Livewire\Component;

class CreatePaymentMethodModal extends Component
{
    public $modalIdName;
    public $identifier;
    public $name;
    public $number;
    public $last4;
    public $validity;
    public $payment_method_type_id = 1;

    public function submit(){
        $request = new PaymentMethodRequest();

        $this->validate(
            $request->rules(),
            $request->messages()
        );


        try {
            PaymentMethod::create([
                'user_id' => auth()->id(),
                'identifier' => $this->identifier,
                'name' => $this->name,
                'payment_method_type_id' => $this->payment_method_type_id,
                'number' => encrypt($this->number),
                'last4' => $this->last4,
                'validity' => encrypt($this->validity),
            ]);

            $this->reset();
            session()->flash('success', 'Método de pagamento criado!');
            return redirect()->route('payment-methods');

        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-payment-method-modal');
    }
}
