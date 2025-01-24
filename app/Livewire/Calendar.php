<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Collection;

class Calendar extends Component
{
    public Carbon $currentDate;
    public ?Carbon $selectedEntryDate = null;
    public ?Carbon $selectedExitDate = null;
    public Collection $events;

    // Estado da seleção
    public ?Carbon $tempStartDate = null;
    public ?Carbon $tempEndDate = null;
    public bool $isSelecting = false;

    public function mount(array $events = []): void
    {
        $this->currentDate = Carbon::now()->startOfMonth();
        $this->initializeEvents($events);
    }

    protected function initializeEvents(array $events): void
    {
        $this->events = collect($events)->map(fn($event) => [
            'date' => Carbon::parse($event['date']),
            'title' => $event['title']
        ]);
    }

    public function debugState(): void
    {
        logger([
            'currentDate' => $this->currentDate->toDateString(),
            'tempStartDate' => $this->tempStartDate?->toDateString(),
            'tempEndDate' => $this->tempEndDate?->toDateString(),
            'selectedEntryDate' => $this->selectedEntryDate?->toDateString(),
            'selectedExitDate' => $this->selectedExitDate?->toDateString(),
        ]);
    }

    public function navigate(string $direction): void
    {
        $this->currentDate = $this->currentDate->clone()
            ->{$direction === 'prev' ? 'subMonth' : 'addMonth'}()
            ->startOfMonth();

        $this->debugState();
    }

    public function getCalendarDaysProperty(): Collection
    {
        $start = $this->currentDate->clone()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $end = $this->currentDate->clone()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

        $calendarDays = collect();

        while ($start->lte($end)) {
            $calendarDays->push([
                'date' => $start->clone(),
                'isCurrentMonth' => $start->month === $this->currentDate->month,
                'isToday' => $start->isToday(),
                'events' => $this->getEventsForDate($start),
            ]);
            $start->addDay();
        }

        return  $calendarDays->chunk(7);
    }


    protected function getEventsForDate(Carbon $date): Collection
    {
        return $this->events->filter(fn($event) => $event['date']->isSameDay($date))->values();
    }

    public function selectDate(string $dateString): void
    {
        $date = Carbon::parse($dateString);

        if ($this->hasCompleteSelection()) {
            $this->resetSelection();
        }

        if (!$this->isSelecting) {
            $this->startNewSelection($date);
        } else {
            $this->completeSelection($date);
        }
    }

    protected function hasCompleteSelection(): bool
    {
        return $this->selectedEntryDate && $this->selectedExitDate;
    }

    protected function startNewSelection(Carbon $date): void
    {
        $this->tempStartDate = $date;
        $this->isSelecting = true;
    }

    protected function completeSelection(Carbon $date): void
    {
        $this->tempEndDate = $date;
        $this->finalizeSelection();
        $this->isSelecting = false;
        $this->dispatch('datesUpdated', [
            'entryDate' => $this->selectedEntryDate,
            'exitDate' => $this->selectedExitDate,
        ]);
    }

    protected function finalizeSelection(): void
    {
        if ($this->tempStartDate->gt($this->tempEndDate)) {
            [$this->tempStartDate, $this->tempEndDate] = [$this->tempEndDate, $this->tempStartDate];
        }

        $this->selectedEntryDate = $this->tempStartDate;
        $this->selectedExitDate = $this->tempEndDate;
    }

    protected function resetSelection(): void
    {
        $this->selectedEntryDate = null;
        $this->selectedExitDate = null;
        $this->tempStartDate = null;
        $this->tempEndDate = null;
        $this->isSelecting = false;
    }

    public function getHighlightedDatesProperty(): Collection
    {
        if (!$this->tempStartDate || !$this->tempEndDate) {
            return collect();
        }
        return $this->calendarDays->flatten(1)
            ->filter(fn($day) => $day['date']->between(
                $this->tempStartDate->startOfDay(),
                $this->tempEndDate->endOfDay()
            ))
            ->pluck('date');
    }

    public function render()
    {
        return view('livewire.calendar', [
            'weeks' => $this->calendarDays,
            'monthName' => $this->currentDate->translatedFormat('F Y'),
            'highlightedDates' => $this->highlightedDates,
        ]);
    }
}
