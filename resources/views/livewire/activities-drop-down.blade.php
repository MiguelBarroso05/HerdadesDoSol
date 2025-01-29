<div class="relative w-full max-w-md " x-data="{ open: false }">
    <!-- Dropdown Trigger -->
    <div class="hs-form-control relative py-3 px-4 w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
        @click="open = !open">
        <div class="flex flex-wrap gap-2">
            @forelse($selectedActivities as $activity)
                <span class="bg-sec px-2 rounded text-sm">
                    {{ $activity->name }}
                </span>
            @empty
                <span class="text-gray-500">Select activities...</span>
            @endforelse
        </div>
        <svg class="absolute top-1/2 right-4 -translate-y-1/2 w-5 h-5 text-gray-500 pointer-events-none"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 9l6 6 6-6" />
        </svg>
    </div>

    <!-- Dropdown Options -->
    <div class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-72 overflow-y-auto"
        x-show="open" @click.outside="open = false" style="display: none;">
        @forelse($activityGroups as $date => $activities)
        <div class="py-2 px-4 border-b border-gray-200">
            <div class="text-sm text-gray-400">{{ $date }}</div>
            @foreach($activities as $activity)
                <label class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer">
                    <span class="ml-2 text-sm">
                        {{ $activity->name }} 
                        ({{Carbon\Carbon::parse($activity->time)->format('H:i')}}h)
                    </span>
                    <input id="activity-{{ $activity->id }}"
                    type="checkbox"
                    wire:click="toggleSelection({{ $activity->id }})"
                        {{ $selectedActivities->has($activity->id) ? 'checked' : '' }}
                            class="form-checkbox rounded-full text-black focus:ring-2 focus:ring-primary dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600"
                    >
                </label>
            @endforeach
        </div>
    @empty
        <div class="px-4 py-2 text-sm text-gray-600">
            No activities available
        </div>
    @endforelse
    </div>
</div>
