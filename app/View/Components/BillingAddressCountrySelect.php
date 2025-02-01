<?php

namespace App\View\Components;

use App\Models\user\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BillingAddressCountrySelect extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public User $user,
        public $countries,
        public $userBillingInfo,
        public $userAddress,
        public $useAddressInfo
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.billing-address-country-select');
    }
}
