<?php

namespace App\Livewire;

use App\Models\accommodation\AccommodationType;
use App\Models\accommodation\Accommodation;
use App\Models\Estate;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateReservation extends Component
{
    public $estates;
    public $favEstate;
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

    #[On('valueUpdated')]
    public function updatenumbersinputs($event)
    {
        if ($event['name'] == 'groupsize') {
            $this->groupsize = $event['value'];
        }
        if ($event['name'] == 'children') {
            $this->children = $event['value'];
        }
    }
    public function show_accommodations_types($estateId)
    {
        $estate = Estate::find($estateId);

        if (!$estate) {
            return [];
        }

        $this->accommodationTypes = $estate->accommodations->map(function ($accommodation) {
            return $accommodation->accommodation_types;
        })->unique('id');
        if (!$this->accommodationTypes->isEmpty()) {
            $this->selectedAccommodationTypeId = $this->accommodationTypes[0]->id;
            $this->show_accommodations();
        }
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
        $this->favEstate = auth()->user()->fav_estate;
        $this->accommodationTypes = $this->show_accommodations_types($this->favEstate);
        $this->selectedAccommodationTypeId = $this->accommodationTypes[0]->id;
        $this->accommodations = $this->show_accommodations();
        $this->estates = Estate::all();
        $this->groupsize = 3;
        $this->children = 1;
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

    public function setDates($dates)
    {
        $this->entryDate = $dates['entryDate'] ? Carbon::parse($dates['entryDate']) : null;
        $this->exitDate = $dates['exitDate'] ? Carbon::parse($dates['exitDate']) : null;
    }
}
