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
        $this->addresses = $this->user->addresses()->orderByPivot('order')->get();
    }

    public function toggleFavorite($addressId)
    {
        $currentFavoriteId = $this->user->addresses()->wherePivot('isFavorite', true)->first()->id ?? null;

        if ($currentFavoriteId == null) {
            $this->user->addresses()->updateExistingPivot($addressId, ['isFavorite' => true]);
        }

        if ($currentFavoriteId) {
            if ($currentFavoriteId == $addressId) {
                $this->user->addresses()->updateExistingPivot($currentFavoriteId, ['isFavorite' => false]);
            }
            else{
                $this->user->addresses()->updateExistingPivot($currentFavoriteId, ['isFavorite' => false]);
                $this->user->addresses()->updateExistingPivot($addressId, ['isFavorite' => true]);
            }
        }
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
