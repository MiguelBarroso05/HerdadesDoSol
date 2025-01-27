<div wire:ignore.self class="modal fade" id="editBillingInfoModal" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 980px;">
        <form wire:submit.prevent="submit">
            <div class="modal-content">
                <div class="hs-d-flex hs-justify-content-end div-close">
                    <x-custom-button type="close" route="{{null}}"/>
                </div>
                <div class="modal-body hs-d-flex">
                    <div class="hs-col-3 hs-mx-5 hs-d-flex hs-flex-column hs-justify-content-evenly">
                        @if($userBillingInfo && $userBillingInfo->name != null)
                            <div class="grid space-y-2">
                                <label for="hs-radioradio-on-right1"
                                       class="cursor-pointer flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 hs-align-items-center hs-fw-light"
                                       style="min-height: 60px;"
                                       wire:click="UseBillingPersonalInfoButton">
                                    <span
                                        class="text-sm text-gray-500 dark:text-neutral-400">Update current billing information</span>
                                    <input type="radio" name="hs-radio-on-right1"
                                           class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded-full primary-color focus:border-primary disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-primary"
                                           id="hs-radioradio-on-right1" checked="">
                                </label>
                                <label for="hs-radioradio-on-right2"
                                       class="cursor-pointer flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 hs-align-items-center hs-fw-light"
                                       style="min-height: 60px;"
                                       wire:click="UsePersonalInfoButton">
                                    <span class="text-sm text-gray-500 dark:text-neutral-400">Use your personal information</span>
                                    <input type="radio" name="hs-radio-on-right1"
                                           class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded-full primary-color focus:border-primary disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-primary"
                                           id="hs-radioradio-on-right2">
                                </label>

                            </div>
                        @endif
                        @if($userBillingInfo && $userBillingInfo->address_id != null)
                            <div class="grid space-y-2">
                                <label for="hs-radioradio-on-right3"
                                       class="cursor-pointer flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 hs-align-items-center hs-fw-light"
                                       style="min-height: 60px;">
                                    <span
                                        class="text-sm text-gray-500 dark:text-neutral-400">Update current address information</span>
                                    <input type="radio" name="hs-radio-on-right2"
                                           class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded-full primary-color focus:border-primary disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-primary"
                                           id="hs-radioradio-on-right3" checked="">
                                </label>

                                <label for="hs-radioradio-on-right4"
                                       class="cursor-pointer flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 hs-align-items-center hs-fw-light"
                                       style="min-height: 60px;">
                                    <span
                                        class="text-sm text-gray-500 dark:text-neutral-400">Use one of your addresses</span>
                                    <input type="radio" name="hs-radio-on-right2"
                                           class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded-full primary-color focus:border-primary disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-primary"
                                           id="hs-radioradio-on-right4">
                                </label>
                            </div>
                        @endif
                    </div>
                    <div class="hs-col-7 hs-align-self-center">
                        <h5 class="modal-title hs-align-self-center" style="color: black !important;"
                            id="exampleModalLabel">BILLING INFORMATION</h5>
                        @if($userBillingInfo && $userBillingInfo->name != null)
                            <div class="hs-d-flex hs-justify-content-between">
                                <p>PERSONAL INFORMATION</p>
                                <button wire:click="deletePersonalInfo" style="border: none; background-color: transparent">
                                    <i class="bi bi-trash fs-5" style="color: red"></i>
                                </button>
                            </div>
                            <div class="hs-row">
                                <!-- Name Input -->
                                <div class="hs-col-md-8">
                                    <div class="hs-form-group">
                                        <label for="name" class="hs-form-control-label">Name</label>
                                        <input
                                            class="hs-form-control @error('name') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="name"
                                            @if($usePersonalInfo)
                                                readonly
                                            value="{{ old('name', auth()->user()->firstname . ' ' . auth()->user()->lastname) }}"
                                            @else
                                                value="{{ old('name', $userBillingInfo->name) }}"
                                            @endif
                                        >
                                        @error('name')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- NIF Input -->
                                <div class="hs-col-md-4">
                                    <div class="hs-form-group">
                                        <label for="nif" class="hs-form-control-label">NIF</label>
                                        <input
                                            class="hs-form-control @error('nif') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="nif"
                                            @if($usePersonalInfo)
                                                readonly
                                            value="{{ old('nif', auth()->user()->nif) }}"
                                            @else
                                                value="{{ old('nif', $userBillingInfo->nif) }}"
                                            @endif
                                        >
                                        @error('nif')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="hs-col-md-8">
                                    <div class="hs-form-group">
                                        <label for="email" class="hs-form-control-label">Email</label>
                                        <input
                                            class="hs-form-control @error('email') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="email"
                                            @if($usePersonalInfo)
                                                readonly
                                            value="{{ old('email', auth()->user()->email) }}"
                                            @else
                                                value="{{ old('email', $userBillingInfo->email) }}"
                                            @endif
                                        >
                                        @error('email')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- Phone Number Input -->
                                <div class="hs-col-md-4">
                                    <div class="hs-form-group">
                                        <label for="phone" class="hs-form-control-label">Phone Number</label>
                                        <input
                                            class="hs-form-control @error('phone') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="phone"
                                            @if($usePersonalInfo)
                                                readonly
                                            value="{{ old('phone', auth()->user()->phone) }}"
                                            @else
                                                value="{{ old('phone', $userBillingInfo->phone) }}"
                                            @endif
                                        >
                                        @error('phone')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($userBillingInfo && $userBillingInfo->address_id != null)
                            <div>
                                <p>ADDRESS INFORMATION</p>
                            </div>
                            <div class="hs-row">
                                <!-- Country Input -->
                                <div class="hs-col-md-4">
                                    <div class="hs-form-group">
                                        <label for="country" class="hs-form-control-label">Country</label>
                                        <input
                                            class="hs-form-control @error('country') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="country"
                                            value="{{ old('country', $userBillingInfo->address->country) }}">
                                        @error('country')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- City Input -->
                                <div class="hs-col-md-8">
                                    <div class="hs-form-group">
                                        <label for="city" class="hs-form-control-label">City</label>
                                        <input
                                            class="hs-form-control @error('city') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="city"
                                            value="{{ old('city', $userBillingInfo->address->city) }}">
                                        @error('city')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- Zipcode Input -->
                                <div class="hs-col-md-4">
                                    <div class="hs-form-group">
                                        <label for="zipcode" class="hs-form-control-label">Zipcode</label>
                                        <input
                                            class="hs-form-control @error('zipcode') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="zipcode"
                                            value="{{ old('zipcode', $userBillingInfo->address->zipcode) }}">
                                        @error('zipcode')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- Street Input -->
                                <div class="hs-col-md-8">
                                    <div class="hs-form-group">
                                        <label for="street" class="hs-form-control-label">Street</label>
                                        <input
                                            class="hs-form-control @error('street') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="street"
                                            value="{{ old('street', $userBillingInfo->address->street) }}">
                                        @error('street')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="hs-d-flex hs-justify-content-end">
                            <button id="create-billing-info-button" type="submit"
                                    class="hs-btn hs-btn-sm hs-ms-auto hs-col-md-4"
                                    style="border: 1px solid #437546; background-color: #E0EBDC;">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
