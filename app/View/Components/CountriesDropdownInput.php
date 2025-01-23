<?php

namespace App\View\Components;

use App\Models\user\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CountriesDropdownInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $countries,
        public User $user
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.countries-dropdown-input');
    }
}
