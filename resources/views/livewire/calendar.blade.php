<section class="relative py-8 sm:p-8">
    <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14">
        <div class="flex items-center justify-between gap-3 mb-5">
            <div class="flex items-center gap-4">
                <h5 class="text-xl leading-8 font-semibold text-gray-900">{{ $monthName }}</h5>
                <div class="flex items-center gap-2">
                    <button type="button"
                        wire:click="navigate('prev')"
                        class="p-2 text-gray-500 rounded hover:bg-gray-100"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <button type="button"
                        wire:click="navigate('next')"
                        class="p-2 text-gray-500 rounded hover:bg-gray-100"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg shadow-sm">
            <div class="grid grid-cols-7 bg-gray-50 border-b border-gray-200">
                @foreach(['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'] as $day)
                    <div class="p-3 text-center text-sm font-medium text-gray-500">{{ $day }}</div>
                @endforeach
            </div>

            <div class="grid grid-cols-7 bg-white">
                @foreach($weeks as $week)
                    @foreach($week as $day)
                        @php
                            $isInRange = $highlightedDates->contains(fn ($d) => $d->isSameDay($day['date']));
                            $isSelected = $selectedEntryDate && $selectedExitDate &&
                                       $day['date']->between($selectedEntryDate, $selectedExitDate);
                            $isStart = $tempStartDate?->isSameDay($day['date']);
                            $isEnd = $selectedExitDate?->isSameDay($day['date']);
                        @endphp

                        <div id="{{ $day['date']->format('Y-m-d') }}"
                            wire:click="selectDate('{{ $day['date']->format('Y-m-d') }}')"
                            class="relative p-3 h-24 border-b border-r border-gray-200 cursor-pointer transition-colors
                                   {{ $day['isCurrentMonth'] ? 'bg-white' : 'bg-gray-50 text-gray-400' }}
                                   {{ $isInRange ? 'bg-blue-50' : '' }}
                                   {{ $isSelected ? 'bg-blue-100' : '' }}
                                   {{ $isStart || $isEnd ? '!bg-blue-600 !text-white' : '' }}
                                   hover:bg-blue-200"
                        >
                            <div class="flex items-center justify-center">
                                <span class="text-sm {{ $day['isToday'] ? 'font-bold text-blue-600' : '' }}">
                                    {{ $day['date']->day }}
                                </span>
                            </div>

                            @if(count($day['events']))
                                <div class="mt-1 space-y-1">
                                    @foreach($day['events'] as $event)
                                        <div class="text-xs p-1 rounded bg-blue-100 text-blue-800 truncate">
                                            {{ $event['title'] }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>
