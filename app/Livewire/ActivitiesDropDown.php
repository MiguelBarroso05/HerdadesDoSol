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
    public array $activityMap = [];
    public function render()
    {
        return view('livewire.activities-drop-down');
    }
    public function mount($activities)
    {
        if (empty($activities)) {
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
    
        // Filtra as atividades
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
    
        $currentActivityIds = $this->activities->flatten()->pluck('id')->toArray();
        if (!empty($this->selected)) {
            $this->selected = array_values( 
                array_filter(
                    $this->selected,
                    fn ($id) => in_array($id, $currentActivityIds)
                )
            );
        }
        // Processa as atividades para exibição
        $this->options = $this->activities->map(function ($activities, $date) {
            return [
                'date' => $date,
                'activities' => $activities->map(function ($activity) {
                    return [
                        'id' => $activity->id,
                        'name' => $activity->name,
                    ];
                }),
            ];
        })->toArray();
    
        // Mapeamento de atividades
        $this->activityMap = [];
        foreach ($this->options as $group) {
            foreach ($group['activities'] as $activity) {
                $this->activityMap[$activity['id']] = $activity['name'];
            }
        }
    }

    public function toggleSelection($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_filter($this->selected, fn($item) => $item !== $id);
            $this->dispatch('updateActivities', $this->selected);
        } else {
            $this->selected[] = $id;
            $this->dispatch('updateActivities', $this->selected);
        }
    }
}
