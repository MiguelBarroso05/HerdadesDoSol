<?php

namespace App\Livewire;

use App\Models\Estate;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
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
    public $selectedActivities;

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
        $this->loadData();
    }

    public function show_accommodations_types()
    {

        $estate = Estate::find($this->selectedEstateId ?? $this->favEstate);

        if (!$estate) {
            return [];
        }

        $this->accommodationTypes = $estate->accommodations->map(function ($accommodation) {
            return $accommodation->accommodation_types;
        })->unique('id');

        if (!$this->accommodationTypes->isEmpty()) {
            $this->selectedAccommodationTypeId = $this->accommodationTypes[0]->id;
        }
    }
    public function show_accommodations()
    {
        
        $query = Estate::find($this->selectedEstateId ?? $this->favEstate)
            ->accommodations()
            ->where('accommodation_type_id', $this->selectedAccommodationTypeId);

        // Verifica se ambas as datas estão definidas
        if ($this->entryDate && $this->exitDate) {
            $entry = Carbon::createFromFormat('d/m/Y', $this->entryDate)->format('Y-m-d');
            $exit = Carbon::createFromFormat('d/m/Y', $this->exitDate)->format('Y-m-d');
            
            $query->whereDoesntHave('reservations', function ($q) use ($entry, $exit) {
                $q->where(function ($innerQuery) use ($entry, $exit) {
                    $innerQuery->where('exit_date', '>', $entry)
                               ->where('entry_date', '<', $exit);
                });
            });
        }

        $this->accommodations = $query->get();
        $this->selectedAccommodation = $this->accommodations->isNotEmpty() ? $this->accommodations->first() : null;
    }
    public function mount()
    {
        $this->user = auth()->user();
        if ($this->user->fav_estate) {
            $this->favEstate = $this->user->fav_estate;
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
        try {
            $data = [
                'estate' => $this->selectedEstateId ?? $this->favEstate,
                'accommodation_type' => $this->selectedAccommodationTypeId,
                'accommodation' => $this->selectedAccommodation ?? $this->accommodations ? $this->accommodations->first()->id : null, 
                'group_size' => $this->groupsize,
                'children' => $this->children,
                'entry_date' => Carbon::createFromFormat('d/m/Y', $this->entryDate)->format('Y-m-d'),
                'exit_date' => Carbon::createFromFormat('d/m/Y', $this->exitDate)->format('Y-m-d'),
                'activities' => $this->selectedActivities,
            ];
        } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
        }
         dd($data);
        // Validar os dados
        $validator = Validator::make($data, [
            'entry_date' => 'required|date',
            'exit_date' => 'required|date|after:entry_date',
            'estate' => 'required|exists:estates,id', // Verifica se o estate existe na tabela estates
            'accommodation' => 'required|exists:accommodations,id', // Verifica se o accommodation existe
            'group_size' => 'required|numeric|min:1|max:8',
            'children' => 'required|numeric|min:0|max:8',
            'activities' => 'nullable|array', // Atividades são opcionais
            'activities.*' => 'exists:activities,id' // Verifica se cada atividade existe
        ]);

        // Se a validação falhar, retornar erros
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Criar a reserva
        try {
            $reservation = new Reservation();
            $reservation->fill([
                'estate_id' => $data['estate'],
                'accommodation_id' => $data['accommodation'],
                'groupsize' => $data['group_size'],
                'children' => $data['children'],
                'entry_date' => $data['entry_date'],
                'exit_date' => $data['exit_date'],
                'user_id' => auth()->id(),
            ]);
            $reservation->save();
        } catch (\Exception $e) {
            dd($e->getMessage()); // Captura e exibe qualquer exceção
        }
        // Adicionar atividades à reserva
        if (!empty($data['activities'])) {
            foreach ($data['activities'] as $activity) {
                $reservation->activities()->attach($activity);
            }
        }

        $this->reset();
        return redirect()->route('client-create-reservations')->with('success', 'Reservation created successfully');
    }

    public function loadData()
    {
        if ($this->entryDate == null || $this->exitDate == null || $this->selectedEstateId == null) {
            return;
        }
        $this->show_accommodations_types();
        $this->show_accommodations();
        $this->show_activities();
    }
    public function setDates($dates)
    {
        $this->entryDate = isset($dates['entryDate'])
            ? Carbon::parse($dates['entryDate'])->format('d/m/Y')
            : null;

        $this->exitDate = isset($dates['exitDate'])
            ? Carbon::parse($dates['exitDate'])->format('d/m/Y')
            : null;
        $this->loadData();
    }
    public function show_activities()
    {
        $tempEntryDate = Carbon::createFromFormat('d/m/Y', $this->entryDate)->format('Y-m-d');
        $tempExitDate = Carbon::createFromFormat('d/m/Y', $this->exitDate)->format('Y-m-d');
        $this->dispatch('show-activities', ['entryDate' => $tempEntryDate, 'exitDate' => $tempExitDate, 'groupSize' => $this->groupsize, 'children' => $this->children, 'estate' => $this->selectedEstateId ?? $this->favEstate]);
    }
    #[On('updateActivities')]
    public function updateActivities($activities)
    {
        $this->selectedActivities = $activities;
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
