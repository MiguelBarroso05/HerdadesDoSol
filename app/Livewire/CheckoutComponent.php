<?php

namespace App\Livewire;

use App\Models\accommodation\Accommodation;
use App\Models\activity\Activity;
use App\Models\Billing;
use App\Models\Estate;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class CheckoutComponent extends Component
{
    public $reservation;
    public $total;
    public $selectedCard;
    public $isReservation;
    public $billingInformation;
    public $billingAddress;
    public $address;


    #[On('valueUpdated')]
    public function changeQuantity($event)
    {   
        $this->total = 0;
        $product = session('cart.' . $event['name']);

        $product['quantity'] = $event['value'];
        session()->put('cart.' . $event['name'], $product);
    }

    public function selectCard($cardId)
    {
        $card = auth()->user()->paymentMethods->find($cardId);
        $this->selectedCard = $card;
    }

    public function mount()
    {
        $this->total = 0;
        $this->selectedCard = auth()->user()->paymentMethods->firstWhere('predefined', 1) ?? auth()->user()->paymentMethods->first();
        $this->billingInformation = Billing::where('user_id', auth()->id())->first();
        $this->billingAddress = $this->billingInformation->address ?? null;
        if (auth()->user()->addresses->first()) {
            $this->address = auth()->user()->addresses->where('isFavorite', 1)->first() ??  auth()->user()->addresses->first();
        }
        if (session()->has('reservation') && $this->isReservation) {

            $this->createReservation(session()->get('reservation'));
        }
    }
    /*
    TODO: dar a opçao do cliente cancelar a reserva logo no checkout
    e ao clicar na reserva(na navbar) com uma reserva em checkout
    redirecionar para o checkout 
    */
    public function createReservation($data)
    {
        try {
            $this->reservation = new Reservation();
            $this->reservation->fill([
                'estate_id' => (int) $data['estate'],
                'accommodation_id' => (int) $data['accommodation'],
                'groupsize' => (int) $data['group_size'],
                'children' => (int) $data['children'],
                'entry_date' => $data['entry_date'],
                'exit_date' => $data['exit_date'],
                'user_id' => (int) auth()->id(),
            ]);
            foreach ($data['activities'] as $activity) {
                $activity = Activity::find($activity);
                $this->total += $activity->price;
            }
            $accommodation = Accommodation::find($this->reservation->accommodation->id);
            $totalNights = Carbon::parse($this->reservation->entry_date)->diffInDays(Carbon::parse($this->reservation->exit_date));
            $this->total += $accommodation->price * $totalNights;
            $this->reservation->price = $this->total;
        } catch (\Exception $e) {
            $this->dispatch('error');
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        if (!empty($data['activities'])) {
            foreach ($data['activities'] as $activity) {
                $this->reservation->activities()->attach($activity);
            }
        }
        session()->put('reservation-checkout', $this->reservation);
    }

    public function render()
    {
        return view('livewire.checkout-component');
    }
    public function submit()
    {
        if (empty($this->selectedCard) || empty($this->billingInformation)) {
            //TODO: pode lançar erros rever
            return;
        }
        if ($this->isReservation) {
            $invoice = new Invoice();
            $invoice->billing_id = $this->billingInformation->id;
            $invoice->payment_method_id = $this->selectedCard->id;
            $invoice->payment_date = now();
            $invoice->save();
            $this->reservation = session()->get('reservation-checkout');
            $this->reservation->invoice_id = $invoice->id;
            $this->reservation->save();
            session()->forget('reservation');
            session()->forget('reservation-checkout');
            redirect()->route('orders.index')->with('success', 'Reservation made successfully. We will contact you soon.');
            return;
        }
        if (empty($this->address)) {
            return;
        }

        $data = $this->prepareDataForOrder();
        $this->validation($data);

        $this->createOrder($data);

        session()->forget('cart');
        redirect()->route('orders.index')->with('success', 'Order made successfully. We will contact you soon.');
    }

    public function prepareDataForOrder()
    {
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

        return $data;
    }

    public function createOrder($data)
    {
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
    }
    public function validation($data)
    {
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
