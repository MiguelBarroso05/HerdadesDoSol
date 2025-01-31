<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::paginate(12)
        ]);
    }
    public function paginationView()
    {
        return 'vendor.pagination.custom';
    }
}
