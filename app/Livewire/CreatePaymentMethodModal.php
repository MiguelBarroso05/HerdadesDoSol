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
    public $validity;
    public $payment_method_type_id = 1;

    public function submit(){
        $request = new PaymentMethodRequest();

        $this->validate(
            $request->rules(),
            $request->messages()
        );

        $encriptNumber = substr($this->number, 0, 12);
        $last4 = substr($this->number, 12, 4);

        try {
            PaymentMethod::create([
                'user_id' => auth()->id(),
                'identifier' => $this->identifier,
                'name' => $this->name,
                'payment_method_type_id' => $this->payment_method_type_id,
                'number' => encrypt($encriptNumber),
                'last4' => $last4,
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
