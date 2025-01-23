<?php

namespace App\Livewire;

use Livewire\Component;

class FavAddress extends Component
{
    public $user;
    public $address;
    public $isFavorite;


    public function mount($user, $address)
    {
        $this->user = $user;
        $this->address = $address;
        $this->isFavorite = $address->pivot->isFavorite;
    }

    public function toggleFavorite()
    {
        $this->user->addresses()->updateExistingPivot($this->address->id, ['isFavorite' => !$this->isFavorite]);

        $this->isFavorite = !$this->isFavorite;

        foreach ($this->user->addresses as $otherAddress) {
            if ($otherAddress->id !== $this->address->id) {
                $this->user->addresses()->updateExistingPivot($otherAddress->id, ['isFavorite' => false]);
            }
        }
    }

    public function render()
    {
        return view('livewire.fav-address');
    }
}
