<?php

namespace App\Livewire;

use App\Models\activity\Activity;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ActivitiesDropDown extends Component
{
    public Collection $activityGroups;
    public Collection $activities;
    public Collection $selectedActivities;

    public function mount()
    {
        $this->activityGroups = collect();
        $this->activities = collect();
        $this->selectedActivities = collect();
    }

    #[On('show-activities')]
    public function loadActivities($data)
    {
        // Consulta otimizada
        $query = Activity::where('estate_id', $data['estate'])
            ->whereBetween('date', [$data['entryDate'], $data['exitDate']])
          ;

        // Filtros condicionais
        $query->where(function($q) use ($data) {
            $q->where(function($sub) use ($data) {
                $sub->where('adult_activity', true)
                    ->where('max_participants', '>=', $data['groupSize'])
                    ->whereRaw('max_participants - participants >= ?', [$data['groupSize']]);
            })->orWhere(function($sub) use ($data) {
                $sub->where('adult_activity', false)
                    ->where('max_participants', '>=', $data['groupSize'] + $data['children'])
                    ->whereRaw('max_participants - participants >= ?', [$data['groupSize'] + $data['children']]);
            });
        });

        // Organização dos dados
        $this->activities = $query->get()->keyBy('id');
        $this->activityGroups = $this->activities->groupBy('date')->toBase();

        // Sincronização das seleções
        $this->selectedActivities = $this->selectedActivities->filter(
            fn(Activity $activity) => $this->activities->has($activity->id)
        );
        $this->dispatch('updateActivities', 
            $this->selectedActivities
        );
    }

    public function toggleSelection(Activity $activity)
    {
        $this->selectedActivities->has($activity->id)
        ? $this->selectedActivities->forget($activity->id)
        : $this->selectedActivities->put($activity->id, $activity);
        
    
        $this->dispatch('updateActivities', 
            $this->selectedActivities
        );
    }

    public function render()
    {
        return view('livewire.activities-drop-down');
    }
}