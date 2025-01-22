<?php

namespace App\Livewire;

use App\Models\accommodation\AccommodationType;
use App\Models\accommodation\Accommodation;
use App\Models\Estate;
use Livewire\Component;

use function PHPSTORM_META\map;

class CreateReservation extends Component
{

    public $estates;
    public $accommodationTypes;
    public $accommodations;
    public $groupsize;
    public $children;
    public $entryDate;
    public $exitDate;

    public $selectedEstateId;
    public $selectedAccommodationTypeId;
    public $selectedAccommodation;

    public function show_accommodations_types($estateId)
    {
        $estate = Estate::find($estateId);

        if (!$estate) {
            return [];
        }

        $this->accommodationTypes = $estate->accommodations->map(function ($accommodation) {
            return $accommodation->accommodation_types;
        })->unique('id');
    }
    public function show_accommodations()
    {
        $this->accommodations = Estate::find($this->selectedEstateId)
            ->accommodations()
            ->where('accommodation_type_id', $this->selectedAccommodationTypeId)
            ->get();
    }
    public function mount()
    {
        $this->estates = Estate::all();
    }

    public function render()
    {
        return view('livewire.create-reservation');
    }

    public function submit()
    {
        // Coletar os dados do formulário
        $data = [
            'estate' => $this->selectedEstateId,
            'accommodation_type' => $this->selectedAccommodationTypeId,
            'accommodation' => $this->accommodations,  // Se estiver selecionado
            'group_size' => $this->groupsize,
            'children' => $this->children,
            'entry_date' => $this->entryDate,
            'exit_date' => $this->exitDate,
        ];

        // Dispara o evento 'show-alert' para o frontend, com os dados
        dd($data);
    }
   
}
