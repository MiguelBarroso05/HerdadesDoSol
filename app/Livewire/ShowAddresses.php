<?php

namespace App\Livewire;

use Livewire\Component;

class ShowAddresses extends Component
{
    public $user;
    public $addresses;

    protected $listeners = ['updateFavorite' => 'updateFavorite'];

    public function mount($user)
    {
        $this->user = $user->load('addresses');
        $this->addresses = $this->user->addresses;
    }

    public function toggleFavorite($addressId)
    {
        $currentFavorite = $this->user->addresses()->wherePivot('isFavorite', true)->first();

        if (!$currentFavorite) {
            $this->user->addresses()->updateExistingPivot($addressId, ['isFavorite' => true]);
            $this->dispatch('updateFavorite');
            return;
        }

        if ($currentFavorite->id === $addressId) {
            $this->user->addresses()->updateExistingPivot($currentFavorite->id, ['isFavorite' => false]);
            $this->dispatch('updateFavorite');
        }

        $this->user->addresses()->updateExistingPivot($currentFavorite->id, ['isFavorite' => false]);
        $this->user->addresses()->updateExistingPivot($addressId, ['isFavorite' => true]);

        $this->addresses = $this->user->fresh()->addresses;

        $this->dispatch('updateFavorite');
    }

    public function updateFavorite(){
        $this->addresses = $this->user->fresh()->addresses;
    }

    public function render()
    {
        return view('livewire.show-addresses', [
            'addresses' => $this->addresses,
        ]);
    }
}
