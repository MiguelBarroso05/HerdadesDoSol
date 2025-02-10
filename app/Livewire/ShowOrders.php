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

    public $expandedBookingId = null;

    public function mount(){
        $this->seeBookings = true;
        $this->orders = auth()->user()->orders ?? null;
        $this->bookings = auth()->user()->reservations ?? null;
    }

    public function showBookings(){
        $this->seeBookings = true;
    }

    public function showOrders(){
        $this->seeBookings = false;
    }

    public function toggleOrderDetails($orderId)
    {
        $this->expandedOrderId = $this->expandedOrderId === $orderId ? null : $orderId;
    }

    public function toggleBookingDetails($bookingId)
    {
        $this->expandedBookingId = $this->expandedBookingId === $bookingId ? null : $bookingId;
    }
    public function render()
    {
        return view('livewire.show-orders');
    }
}
