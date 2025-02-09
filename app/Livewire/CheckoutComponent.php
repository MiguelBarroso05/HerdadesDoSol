<?php

namespace App\Livewire;

use App\Models\Billing;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
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
        if (empty($this->selectedCard) || empty($this->billingInformation) || empty($this->address)) {
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
        for ($i = 0; $i < count(session('cart')); $i++) {
            $id = array_keys(session('cart'))[$i];
            $product = session('cart')[$id];
            if ($product['quantity'] > Product::find($id)->stock) {
                session()->forget('cart.' . $id);
                $this->total -= $product['price'] * $product['quantity'];
                return session()->flash('error', 'Product out of stock');
            }
            $quantity = $product['quantity'];
            $data['products'][] = ['product' => $id, 'quantity' => $quantity];
        }

        $this->validation($data);

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
                $productObject = Product::find($product['product']);
                $productObject->stock -= $product['quantity'];
                $productObject->save();
            }
        }
        session()->forget('cart');
        redirect()->route('orders.index')->with('success', 'Order made successfully. We will contact you soon.');
    }
    public function validation($data){
        Validator::validate($data, [
            'user' => 'required|integer|exists:users,id',
            'paymentMethod' => 'required|integer|exists:payment_methods,id',
            'billingInformation' => 'required|integer|exists:billings,id',
            'address' => 'required|integer|exists:addresses,id',
            'products' => 'required|array',
            'products.*.product' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0'
        ]);
    }
}
