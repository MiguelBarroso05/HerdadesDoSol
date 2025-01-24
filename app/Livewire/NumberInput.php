<?php

namespace App\Livewire;

use Livewire\Component;

class NumberInput extends Component
{
    public $value = 1;
    public $name;
    public function render()
    {
        return view('livewire.number-input', [
            'name' => $this->name,]);
    }
    public function increase()
    {
        $this->value++;
        $event = [
            'name' => $this->name,	
            'value' => $this->value,
        ];
        $this->dispatch('valueUpdated', $event); 
    }

    public function decrease()
    {
        if ($this->value > 0) {
            $this->value--;
            $event = [
                'name' => $this->name,	
                'value' => $this->value,
            ];
            $this->dispatch('valueUpdated', $event); 
        }
    }
}
