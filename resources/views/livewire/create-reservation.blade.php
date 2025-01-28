    <form wire:submit="submit">
        <style>
            .loader {

            }
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

            <div class="hs-bg-gradient-danger hs-w-70">
                <div class="hs-bg-dark hs-w-100 hs-py-3 hs-d-inline-flex hs-justify-content-between hs-px-1">
                    <div class="hs-w-25 ">
                        <!-- Select -->
                        <select wire:model="selectedEstateId" wire:change="show_accommodations_types($event.target.value)"
                            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500
                         focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900
                          dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500
                           dark:focus:ring-neutral-600">
                            <option @if (!auth()->user()->fav_estate) selected @endif disabled>Select a Estate</option>
                            @foreach ($estates as $estate)
                                <option value="{{ $estate->id }}">{{ $estate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- End Select -->
                    <div class="hs-w-25">
                        <div class="max-w-sm space-y-3">
                            <input wire:model="entryDate" wire:change="show_activities" type="text"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="dd/mm/yyyy" maxlength="10"
                                oninput="this.value = this.value
                                       .replace(/[^0-9]/g, '')  // Remove caracteres não numéricos
                                       .replace(/(\d{2})(\d{1,2})?(\d{1,4})?/, (m, d, mth, y) =>
                                           [d, mth, y].filter(Boolean).join('/'));">
                        </div>
                    </div>

                    <div class="hs-w-25">
                        <div class="max-w-sm space-y-3">
                            <input wire:model="exitDate" wire:change="show_activities" type="text"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="dd/mm/yyyy" maxlength="10"
                                oninput="this.value = this.value
                                       .replace(/[^0-9]/g, '')  // Remove caracteres não numéricos
                                       .replace(/(\d{2})(\d{1,2})?(\d{1,4})?/, (m, d, mth, y) =>
                                           [d, mth, y].filter(Boolean).join('/'));">
                        </div>
                    </div>

                </div>
                <div class="hs-bg-card hs-w-100 hs-h-100">
                    <livewire:Calendar wire:model:selectedEntryDate="entryDate"
                        wire:model:selectedExitDate="exitDate" />
                </div>
            </div>
            <div class="hs-bg-gradient-warning hs-w-30 hs-p-3">
                <div class="hs-d-inline-flex justify-between">
                    <div class="hs-w-45">
                        <livewire:NumberInput wire:model="groupsize" :name="'groupsize'" :value="$groupsize" />
                    </div>
                    <div class="hs-w-45">
                        <livewire:NumberInput wire:model="children" :name="'children'" :value="$children" />
                    </div>
                </div>
                <div class="relative">
                    <x-dropdown-input id="{{now()}}" wire:model="selectedAccommodationTypeId" wire:change="show_accommodations"
                        :multiple="false" :placeholder="'Select a Accommodation Type'" :fixed="'bottom'" :name="'accommodation_types'" :object="$accommodationTypes"
                        :optionText="'name'" :user="auth()->user()" :paramter="null" />
                    <x-dropdown-input wire:model="selectedAccommodation" :multiple="false" :placeholder="'Select a Accommodation'"
                        :fixed="'bottom'" :name="'accommodation'" :object="$accommodations" :user="auth()->user()" :paramter="null"
                        :optionText="'size'" />
                </div>

                <livewire:ActivitiesDropDown :activities="$activities" />
                <button type="submit">Reservar</button>
            </div>
        </div>
    </form>
