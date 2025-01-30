<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class ShowOrders extends Component
{
    public $bookingOrders;
    public $orders;

    public function mount(){
        $this->bookingOrders = true;
        $this->orders = auth()->user()->bookingOrders ?? null;
    }

    public function showBookingOrders(){
        $this->bookingOrders = true;
        $this->orders = auth()->user()->bookingOrders ?? null;
    }

    public function showProductOrders(){
        $this->bookingOrders = false;
        $this->orders = auth()->user()->productOrders ?? null;
    }

    public function render()
    {
        return view('livewire.show-orders');
    }
}
