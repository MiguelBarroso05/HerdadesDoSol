<?php

namespace App\Livewire;

use App\Models\Billing;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $total;
    public $selectedCard;
    public $isReservation;
    public $billingInformation;
    public $billingAddress;
    public $address;

    public function selectCard($cardId)
    {
        $card = auth()->user()->paymentMethods->find($cardId);
        $this->selectedCard = $card;
    }

    public function mount()
    {
        $this->total = 0;
        $this->selectedCard = auth()->user()->paymentMethods->firstWhere('predefined', 1) ?? auth()->user()->paymentMethods->first();
        $this->billingInformation = Billing::where('user_id', auth()->id())->first() ;
        $this->billingAddress = $this->billingInformation->address ?? null;
        if (auth()->user()->addresses->first()) {
            $this->address = auth()->user()->addresses->where('isFavorite', 1)->first() ??  auth()->user()->addresses->first();
            
        }
    }
    public function render()
    {
        return view('livewire.checkout-component');
    }
    public function submit()
    {
        if ($this->isReservation) {
            return;
        }
        $data = [
            'user' => auth()->user()->id,
            'paymentMethod' => $this->selectedCard->id,
            'billingInformation' => $this->billingInformation->id,
            'address' => $this->address->id,
            'products' => [],
            'total' => $this->total
        ];
        foreach (session('cart') as $id => $product) {
            $quantity = $product['quantity'];
            $data['products'][] = ['product' => $id, 'quantity' => $quantity];
        }
        $order = new Order();
        $invoice = new Invoice();
        $invoice->billing_id = $data['billingInformation'];
        $invoice->payment_method_id = $data['paymentMethod'];
        $invoice->payment_date = now();
        $invoice->save();
        $order->user_id = $data['user'];
        $order->address_id = $data['address'];
        $order->price = $data['total'];
        $order->invoice_id = $invoice->id;
        $order->save();
        if (!empty($data['products'])) {
            foreach ($data['products'] as $product) {
                $order->products()->attach($product['product'], ['quantity' => $product['quantity']]);
            }
        }
        redirect()->route('orders.index')->with('success', 'Order made successfully.\nWe will contact you soon.'); 
    
    }
}
