<?php

namespace App\Livewire;

use Livewire\Component;

class NumberInput extends Component
{
    public $value = 1;
    public $name;
    public $max;
    private $processing = false;
    public function render()
    {
        return view('livewire.number-input', [
            'name' => $this->name,]);
    }
    public function increase()
    {
        if ($this->value >= $this->max) {
            return;
        }
        $this->value++;
        $event = [
            'name' => $this->name,	
            'value' => $this->value,
        ];
        $this->dispatch('valueUpdated', $event); 
    }

    public function decrease()
    {
        if ($this->value == 0) {
            return;
        }
            $this->value--;
            $event = [
                'name' => $this->name,	
                'value' => $this->value,
            ];
            $this->dispatch('valueUpdated', $event); 
        
    }
}
