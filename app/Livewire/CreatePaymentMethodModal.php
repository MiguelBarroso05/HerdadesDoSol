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
    public $type = "visa";

    public function submit(){

        $request = new PaymentMethodRequest();

        // Validação
        $this->validate(
            $request->rules(),
            $request->messages()
        );

        try {
            PaymentMethod::create([
                'user_id' => auth()->id(),
                'identifier' => $this->identifier,
                'name' => $this->name,
                'type' => $this->type,
                'number' => preg_replace('/[^0-9]/', '', $this->number),
                'last4' => $this->last4,
                'validity' => $this->validity
            ]);

            $this->reset();
            session()->flash('success', 'Método de pagamento criado!');
            return redirect()->route('payment-methods');

        } catch (\Exception $e) {
            session()->flash('error', 'ERRO: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-payment-method-modal');
    }
}
