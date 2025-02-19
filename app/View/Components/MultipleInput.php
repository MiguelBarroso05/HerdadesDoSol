<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class MultipleInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $object,
        public string $placeholder,
        public string $fixed,
        public string $name,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.multiple-input');
    }
}
