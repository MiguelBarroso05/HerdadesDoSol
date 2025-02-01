<?php

namespace App\Livewire;

use App\Http\Controllers\CartController;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductShow extends Component
{
    public int $quantity;
    public $product;
    public function render()
    {
        return view('livewire.product-show');
    }

    public function mount(Product $product)
    {
        $this->quantity = 1;
        $this->product = $product;
    }

    #[On('valueUpdated')]
    public function valueUpdated($envent)
    {
        $this->quantity = $envent['value'];
    }


    public function addToCart()
    {

        $this->validate([
            'quantity' => 'required|integer|min:1|max:8'
        ]);

        // Chama diretamente o controller





        return redirect()->route('cart.add', ['id' => $this->product->id, 'quantity' => $this->quantity] );
    }
}
