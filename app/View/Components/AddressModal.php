<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddressModal extends Component
{
    public $address;
    public $user;

    /**
     * Create a new component instance.
     */
    public function __construct($address, $user)
    {
        $this->address = $address;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.address-modal');
    }
}
