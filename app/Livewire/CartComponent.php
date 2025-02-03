<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartItems = [];
    public $products = [];
    public $showCart = false;

    public function toggleCart()
    {
        $this->showCart = !$this->showCart;
    }

    public function mount()
    {
        // Retrieve your cart items and products from session, database, etc.
        // For example, if you're storing the cart in session:
        $this->cartItems = session('cart', []);
        // Assume $this->products is an associative array where keys are product IDs.
        $this->products = $this->getProducts(array_keys($this->cartItems));
    }

    protected function getProducts(array $productIds)
    {
        // Replace this with your actual query logic.
        // For instance, assuming you have a Product model:
        return \App\Models\Product::whereIn('id', $productIds)
                    ->get()
                    ->keyBy('id')
                    ->toArray();
    }


    public function render()
    {
        return view('livewire.cart-component', [
            'cartItems' => $this->cartItems, // Passa explicitamente para a view
            'products' => $this->products
        ]);
    }
}
