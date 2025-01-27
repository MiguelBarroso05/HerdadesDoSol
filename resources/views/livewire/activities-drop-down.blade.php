<div class="relative w-full max-w-md" x-data="{ open: false }">
  <!-- Dropdown Trigger -->
  <div 
      class="relative py-3 px-4 w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
      @click="open = !open"
  >
      <div class="flex flex-wrap gap-2">
        @forelse($selected as $id)
            @php 
                // Encontra o item correspondente ao ID selecionado
                $item = collect($options)->flatten(1)->firstWhere('id', $id);
            @endphp
            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-sm">
                {{ !empty($item['name']) ? $item['name'] : 'Unknown' }}
            </span>
        @empty
            <span class="text-gray-500">Select activities...</span>
        @endforelse
    </div>
      <svg class="absolute top-1/2 right-4 -translate-y-1/2 w-5 h-5 text-gray-500 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 9l6 6 6-6" />
      </svg>
  </div>

  <!-- Dropdown Options -->
  <div 
      class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-72 overflow-y-auto"
      x-show="open" @click.outside="open = false"
      style="display: none;"
  >
      @foreach($options as $group)
          <div class="py-2 px-4 border-b border-gray-200">
              <div class="font-semibold text-gray-800 dark:text-neutral-200">{{ $group['date'] }}</div>
              @foreach($group['activities'] as $activity)
                  <label class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-800 cursor-pointer">
                      <input 
                          type="checkbox" 
                          wire:click="toggleSelection({{ $activity['id'] }})"
                          {{ in_array($activity['id'], $selected) ? 'checked' : '' }}
                          class="form-checkbox rounded text-blue-500"
                      />
                      <span class="ml-2 text-sm text-gray-800 dark:text-neutral-200">
                          {{ $activity['name'] }}
                      </span>
                  </label>
              @endforeach
          </div>
      @endforeach
  </div>
</div>
