<?php

namespace App\View\Components;

use App\Models\user\Address;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddressCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Address $address,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.address-card');
    }
}
