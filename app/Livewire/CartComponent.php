<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartItems = [];
    public $products = [];

    public function mount()
    {
        $this->cartItems = session()->get('cart', []);
        $this->loadProducts();
    }

    private function loadProducts()
    {
        $productIds = array_keys($this->cartItems);
        $this->products = Product::whereIn('id', $productIds)
            ->get()
            ->keyBy('id');
    }


    public function render()
    {
        return view('livewire.cart-component', [
            'cartItems' => $this->cartItems, // Passa explicitamente para a view
            'products' => $this->products
        ]);
    }
}
