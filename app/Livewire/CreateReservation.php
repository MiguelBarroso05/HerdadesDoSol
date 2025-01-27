<?php

namespace App\Livewire;

use App\Models\accommodation\AccommodationType;
use App\Models\accommodation\Accommodation;
use App\Models\activity\Activity;
use App\Models\Estate;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateReservation extends Component
{
    public $user;
    public $estates;
    public $favEstate;
    public $accommodationTypes;
    public $accommodations;
    public $activities;
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
        $this->show_activities();
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
            // dd($this->selectedAccommodationTypeId);
            $this->show_accommodations();
            $this->show_activities();
        }
    }
    public function show_accommodations()
    {
        // dd($this->selectedAccommodationTypeId);
        $this->accommodations = Estate::find($this->selectedEstateId ?? $this->favEstate)
            ->accommodations()
            ->where('accommodation_type_id', $this->selectedAccommodationTypeId)
            ->get();
    }
    public function mount()
    {
        $this->user = auth()->user();
        if ($this->user->fav_estate) {
            $this->favEstate = $this->user->fav_estate;
            $this->show_accommodations_types($this->favEstate);
        }

        $this->estates = Estate::all();

        $this->groupsize = $this->user->standard_group ?? 1;
        $this->children = $this->user->children ?? 0;
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
        $this->entryDate = isset($dates['entryDate'])
            ? Carbon::parse($dates['entryDate'])->format('d/m/Y')
            : null;

        $this->exitDate = isset($dates['exitDate'])
            ? Carbon::parse($dates['exitDate'])->format('d/m/Y')
            : null;
        $this->show_activities();
    }
    public function show_activities()
    {

        if ($this->entryDate == null || $this->exitDate == null) {
            return;
        }
        $tempEntryDate = Carbon::createFromFormat('d/m/Y', $this->entryDate)->format('Y-m-d');
        $tempExitDate = Carbon::createFromFormat('d/m/Y', $this->exitDate)->format('Y-m-d');
        $this->dispatch('show-activities', ['entryDate' => $tempEntryDate, 'exitDate' => $tempExitDate, 'groupSize' => $this->groupsize, 'children' => $this->children, 'estate' => $this->selectedEstateId ?? $this->favEstate]);
    }
    public function placeholder()
    {
        return <<<'HTML'
        <form class="hs-d-flex hs-justify-content-center hs-align-items-center">
            <div class="">
                <span style="width: 48px;
                    height: 48px;
                    border: 5px solid #FFF;
                    border-bottom-color: #FF3D00;
                    border-radius: 50%;
                    display: inline-block;
                    box-sizing: border-box;
                    animation: rotation 1s linear infinite;"></span>
                <style>
                    @keyframes rotation {
                        0% {
                            transform: rotate(0deg);
                        }
                        100% {
                            transform: rotate(360deg);
                        }
                    }
                </style>
            </div>
        </form>
        HTML;
    }
}
