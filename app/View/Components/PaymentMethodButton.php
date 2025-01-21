<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaymentMethodButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $icon,
        public string $text,

    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.payment-method-button');
    }
}
