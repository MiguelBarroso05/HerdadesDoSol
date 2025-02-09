<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class ShowOrders extends Component
{
    public $seeBookings;
    public $orders;
    public $bookings;
    public $expandedOrderId = null;

    public function mount(){
        $this->seeBookings = true;
        $this->orders = auth()->user()->bookingOrders ?? null;
        $this->bookings = null;
    }

    public function showBookings(){
        $this->seeBookings = true;
        //$this->orders = auth()->user()->bookingOrders ?? null;
    }

    public function showOrders(){
        $this->seeBookings = false;
        $this->orders = auth()->user()->orders ?? null;
    }

    public function toggleOrderDetails($orderId)
    {
        $this->expandedOrderId = $this->expandedOrderId === $orderId ? null : $orderId;
    }

    public function render()
    {
        return view('livewire.show-orders');
    }
}
