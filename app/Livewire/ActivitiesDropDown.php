<?php

namespace App\Livewire;

use App\Models\activity\Activity;
use Livewire\Attributes\On;
use Livewire\Component;

class ActivitiesDropDown extends Component
{
    public $activities;
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
    public function show_activities($data){
        $estate = $data['estate'];
        $entryDate = $data['entryDate'];
        $exitDate = $data['exitDate'];
        $groupsize = $data['groupSize'];
        $children = $data['children'];

        // Executar a consulta com os dados passados
        $this->activities = Activity::where('estate_id', $estate)
            ->where('date', '>=', $entryDate)
            ->where('date', '<=', $exitDate)
            ->where(function ($query) use ($groupsize, $children) {
                // Para atividades adultas
                $query->where(function ($subQuery) use ($groupsize) {
                    $subQuery->where('max_participants', '>=', $groupsize)
                             ->where('adult_activity', true)
                             ->whereRaw('max_participants >= participants + ?', [$groupsize]);
                })
                // Para atividades com crianças
                ->orWhere(function ($subQuery) use ($groupsize, $children) {
                    $subQuery->where('max_participants', '>=', $groupsize + $children)
                             ->where('adult_activity', false)
                             ->whereRaw('max_participants >= participants + ?', [$groupsize + $children]);
                });
            })
            ->get()
            ->groupBy('date')->toBase();
    }
    
    
}
