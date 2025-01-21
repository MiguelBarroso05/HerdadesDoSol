<?php

namespace App\View\Components;

use App\Models\user\Address;
use App\Models\user\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmDeletion extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $modalId,
        public string $title,
        public string $message,
        public string $route,
        public string $prevModalId
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-deletion');
    }
}
