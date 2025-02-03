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

        $this->cartItems = session('cart', []);
        $this->products = $this->getProducts(array_keys($this->cartItems));
    }

    protected function getProducts(array $productIds)
    {
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
