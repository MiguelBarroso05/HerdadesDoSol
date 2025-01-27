<?php

namespace App\Livewire;

use Livewire\Component;

class DropDownInputTEST extends Component
{
    public $multiple = false;
    public $placeholder;
    public $fixed;
    public $name;
    public $object;
    public $user;
    public $paramter;
    public $optionText;
    public function render()
    {
        return view('livewire.drop-down-input-t-e-s-t');
    }
}
