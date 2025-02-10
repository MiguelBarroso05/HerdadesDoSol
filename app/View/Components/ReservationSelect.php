<?php

namespace App\View\Components;

use App\Models\user\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReservationSelect extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $placeholder,
        public string $fixed,
        public string $name,
        public $object,
        public $paramter,
        public $optionText,
        public $set,
        public $call,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reservation-select');
    }
}
