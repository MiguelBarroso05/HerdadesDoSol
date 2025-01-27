<?php

namespace App\Livewire;

use App\Models\activity\Activity;
use Livewire\Attributes\On;
use Livewire\Component;

class ActivitiesDropDown extends Component
{
    public array $options = [];
    public $activities;
    public array $selected = [];
    public function render()
    {
        return view('livewire.activities-drop-down');
    }
    public function mount($activities){
        if (empty($activities) ){
            $this->activities = [];
        }        
    }
    #[On('show-activities')]
    public function show_activities($data)
    {
        $estate = $data['estate'];
        $entryDate = $data['entryDate'];
        $exitDate = $data['exitDate'];
        $groupsize = $data['groupSize'];
        $children = $data['children'];

        // Filtra as atividades de acordo com os critérios fornecidos
        $this->activities = Activity::where('estate_id', $estate)
            ->where('date', '>=', $entryDate)
            ->where('date', '<=', $exitDate)
            ->where(function ($query) use ($groupsize, $children) {
                $query->where(function ($subQuery) use ($groupsize) {
                    $subQuery->where('max_participants', '>=', $groupsize)
                             ->where('adult_activity', true)
                             ->whereRaw('max_participants >= participants + ?', [$groupsize]);
                })
                ->orWhere(function ($subQuery) use ($groupsize, $children) {
                    $subQuery->where('max_participants', '>=', $groupsize + $children)
                             ->where('adult_activity', false)
                             ->whereRaw('max_participants >= participants + ?', [$groupsize + $children]);
                });
            })
            ->get()
            ->groupBy('date')
            ->toBase();

        // Processa as atividades para exibição no dropdown
        $this->options = $this->activities->map(function ($activities, $date) {
            return [
                'date' => $date,
                'activities' => $activities->map(function ($activity) {
                    return [
                        'id' => $activity->id,
                        'name' => $activity->name,  // Verifique se o nome existe aqui
                    ];
                }),
            ];
        })->toArray();
    
        // Verifique as opções para garantir que o nome está presente
        // dd($this->options); 
    }

    public function toggleSelection($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_filter($this->selected, fn($item) => $item !== $id);
        } else {
            $this->selected[] = $id;
            
        }
    }
    
}
