<?php

namespace App\View\Components;

use App\Models\Address;
use App\Models\user\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowAddressModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Address $address,
        public User $user,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show-address-modal');
    }
}
