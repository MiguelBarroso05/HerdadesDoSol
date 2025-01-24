<?php

namespace App\Livewire;

use App\Models\user\User;
use Livewire\Attributes\On;
use Livewire\Component;

class AddressCard extends Component
{
    public $user;
    public $address;
    public $isFavorite;

    public function mount($user, $address)
    {
        $this->user = $user->load('addresses');
        $this->address = $address;
        $this->isFavorite = $user->addresses()->wherePivot('isFavorite', true)->exists() &&
            $user->addresses()->wherePivot('isFavorite', true)->first()->id == $address->id;
    }

    public function toggleFavorite()
    {
        if ($currentFavorite = $this->user->addresses()->wherePivot('isFavorite', true)->first()) {
            $this->user->addresses()->updateExistingPivot($currentFavorite->id, ['isFavorite' => false]);
        }

        $this->user->addresses()->updateExistingPivot($this->address->id, ['isFavorite' => true]);

        $this->isFavorite = true;
    }
    public function render()
    {
        return view('livewire.address-card');
    }
}
