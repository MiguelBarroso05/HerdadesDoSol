<?php

namespace App\Livewire;

use App\Models\accommodation\AccommodationType;
use App\Models\accommodation\Accommodation;
use App\Models\Estate;
use Carbon\Carbon;
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

    protected $listeners = [
        'datesUpdated' => 'setDates',
    ];


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
        $this->groupsize = 3;
        $this->children = 1;
        // $this->entryDate = "09/01/2025";
        // $this->exitDate = "09/01/2025";
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
   
    public function setDates($dates){
        $this->entryDate = $dates['entryDate'] ? Carbon::parse($dates['entryDate']) : null;
        $this->exitDate = $dates['exitDate'] ? Carbon::parse($dates['exitDate']) : null;
    }
   
}