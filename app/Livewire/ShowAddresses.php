<?php

namespace App\Livewire;

use Livewire\Component;

class ShowAddresses extends Component
{
    public $user;
    public $addresses;

    public function mount($user)
    {
        $this->user = $user->load('addresses');
        $this->addresses = $this->user->addresses;
    }

    public function toggleFavorite($addressId)
    {
        if ($currentFavorite = $this->user->addresses()->wherePivot('isFavorite', true)->first()) {
            $this->user->addresses()->updateExistingPivot($currentFavorite->id, ['isFavorite' => false]);
        }

        $this->user->addresses()->updateExistingPivot($addressId, ['isFavorite' => true]);

        $this->addresses = $this->user->fresh()->addresses;
    }

    public function render()
    {
        return view('livewire.show-addresses', [
            'addresses' => $this->addresses,
        ]);
    }
}

