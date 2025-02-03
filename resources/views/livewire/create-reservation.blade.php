   <form wire:submit="submit">
       <!-- Error Messages -->
       <x-general-errors />
       <!-- Sucess Message -->
       <x-success-message />
       <style>
           .loader {}
       </style>
       <div class="hs-d-flex ">
           <style>
               .selected {
                   background-color: #2563eb;
                   color: white;
                   font-weight: bold;
               }

               .range {
                   background-color: #93c5fd;
               }
           </style>

           <div class="hs-bg-card hs-w-70 hs-p-3 hs-me-3 hs-rounded-3">
               <div class="hs-w-100 hs-py-3 hs-d-inline-flex hs-justify-content-between hs-px-4">
                   <div class="hs-w-25 hs-form-group ">
                       <label class="hs-form-control-label" for="groupsize">Estate</label>
                       <!-- Select -->
                       <select wire:model="selectedEstateId" wire:change="loadData"
                           class="hs-form-control py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500
                         focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900
                          dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500
                           dark:focus:ring-neutral-600">
                           <option @if (!auth()->user()->fav_estate) selected @endif @if ($selectedEstateId) disabled @endif>Select a Estate</option>
                           @foreach ($estates as $estate)
                               <option value="{{ $estate->id }}">{{ $estate->name }}</option>
                           @endforeach
                       </select>
                   </div>
                   <!-- End Select -->
                   <div class="hs-form-group" style="width: 11%;">
                       <div class="max-w-sm">
                           <label class="hs-form-control-label" for="groupsize">Check In</label>
                           <input wire:model="entryDate" wire:change="loadData" type="text"
                               class="hs-form-control py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                               placeholder="dd/mm/yyyy" maxlength="10"
                               oninput="this.value = this.value
                                       .replace(/[^0-9]/g, '')  
                                       .replace(/(\d{2})(\d{1,2})?(\d{1,4})?/, (m, d, mth, y) =>
                                           [d, mth, y].filter(Boolean).join('/'));">
                       </div>
                   </div>

                   <div class="hs-form-group" style="width: 11%;">
                       <div class="max-w-sm">
                           <label class="hs-form-control-label" for="groupsize">Check Out</label>
                           <input wire:model="exitDate" wire:change="loadData" type="text"
                               class="hs-form-control py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                               placeholder="dd/mm/yyyy" maxlength="10"
                               oninput="this.value = this.value
                                       .replace(/[^0-9]/g, '')  
                                       .replace(/(\d{2})(\d{1,2})?(\d{1,4})?/, (m, d, mth, y) =>
                                           [d, mth, y].filter(Boolean).join('/'));">
                       </div>
                   </div>
                   <div class="hs-w-15 hs-form-group">
                       <label class="hs-form-control-label" for="groupsize">Adults</label>
                       <livewire:NumberInput class="hs-form-control" wire:model="groupsize" wire:change="loadData"
                           :name="'groupsize'" :value="$groupsize" :max="8" />
                   </div>
                   <div class="hs-w-15 hs-form-group">
                       <label class="hs-form-control-label" for="children">Children</label>
                       <livewire:NumberInput class="hs-form-control" wire:model="children" wire:change="loadData"
                           :name="'children'" :value="$children" :max="8" />
                   </div>
               </div>
               <div class=" hs-w-100">
                   <livewire:Calendar wire:model:selectedEntryDate="entryDate" wire:model:selectedExitDate="exitDate" />
               </div>
           </div>
           <div class="bg-[#143633] hs-rounded-3 hs-w-30 hs-p-3" style="opacity: 0.82; min-width: 470px;">
            <div class="relative {{ (($selectedEstateId || $user->fav_estate) && $entryDate && $exitDate) ? '' : 'hs-d-none' }}">
                   <div class="hs-form-group">
                       <label for="accommodation_types" class="hs-form-control-label text-white"> Accommodation
                           Type</label>
                       <x-dropdown-input id="{{ now() }}" wire:model="selectedAccommodationTypeId"
                           wire:change="show_accommodations" :multiple="false" :placeholder="'Select a Accommodation Type'" :fixed="'bottom'"
                           :name="'accommodation_types'" :object="$accommodationTypes" :optionText="'name'" :user="auth()->user()"
                           :paramter="null" />
                   </div>
                   <div class="hs-form-group">
                       <label for="accommodation" class="hs-form-control-label text-white"> Accommodation</label>
                       <x-dropdown-input wire:model="selectedAccommodation" :multiple="false" :placeholder="'Select a Accommodation'"
                           :fixed="'bottom'" :name="'accommodation'" :object="$accommodations" :user="auth()->user()"
                           :paramter="null" :optionText="'size'" />
                   </div>
                   <div class="hs-form-group">
                       <label for="accommodation" class="hs-form-control-label text-white"> Activities</label>
                       <livewire:ActivitiesDropDown class="hs-form-control" />
                   </div>
               </div>
               <div>
                   <h3 class="text-lg font-bold mb-3 text-white">Booking Summary</h3>
                   <p class="text-sm leading-relaxed text-white">
                       @if ($selectedEstateId)
                           Your stay at <span
                               class="font-semibold !text-yellow-200">{{ $estates->find($selectedEstateId)?->name }}</span>
                       @endif

                       @if ($entryDate && $exitDate)
                           is booked from <span class="font-semibold !text-yellow-200">{{ $entryDate }}</span>
                           to <span class="font-semibold !text-yellow-200">{{ $exitDate }}</span>
                           (
                           @php
                               $entry = \Carbon\Carbon::createFromFormat('d/m/Y', $entryDate);
                               $exit = \Carbon\Carbon::createFromFormat('d/m/Y', $exitDate);
                               $nights = $exit->diffInDays($entry) * -1;
                           @endphp
                           <span class="font-semibold !text-yellow-200">
                               {{ $nights == 1 ? '1 night' : $nights . ' nights' }}
                           </span>
                           )
                       @endif

                       @if ($groupsize || $children)
                           The reservation is for
                           @if ($groupsize)
                               <span class="font-semibold !text-yellow-200">{{ $groupsize }}
                                   adult{{ $groupsize > 1 ? 's' : '' }}</span>
                           @endif
                           @if ($children)
                               and <span class="font-semibold !text-yellow-200">{{ $children }}
                                   child{{ $children > 1 ? 'ren' : '' }}</span>
                           @endif.
                       @endif

                       @if ($selectedAccommodationTypeId)
                           You've selected a <span
                               class="font-semibold !text-yellow-200">{{ $accommodationTypes->find($selectedAccommodationTypeId)?->name }}</span>-type
                           accommodation
                       @endif

                       @if ($selectedAccommodation)
                           with capacity for <span
                               class="font-semibold !text-yellow-200">{{ $accommodations->find($selectedAccommodation)?->size }}
                               guests</span>.
                       @endif
                       @if (!empty($selectedActivities))
                           Your experience will include:
                           <span class="font-semibold !text-yellow-200">
                               @php
                                   $activityNames = is_array($selectedActivities)
                                       ? array_column($selectedActivities, 'name')
                                       : $selectedActivities->pluck('name')->toArray();

                                   echo implode(', ', $activityNames);
                               @endphp
                           </span>.
                       @endif
                       {{-- @if ($totalPrice)
                    <span class="block mt-2 pt-2 border-t border-white/20">Estimated total: <span class="font-bold text-lg">€{{ number_format($totalPrice, 2) }}</span></span>
                    @endif --}}
                   </p>
               </div>
               <button class="hs-btn hs-btn-primary hs-btn-sm" type="submit">Reservar</button>
           </div>
       </div>
   </form>
