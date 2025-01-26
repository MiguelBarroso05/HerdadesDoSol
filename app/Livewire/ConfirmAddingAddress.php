<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmAddingAddress extends Component
{

    #[On('showConfirmationModal')]
    public function render()
    {
        return view('livewire.confirm-adding-address');
    }
}
