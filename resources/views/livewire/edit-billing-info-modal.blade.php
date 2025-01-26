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
                        <div class="grid space-y-2">
                            <x-billing-checkbox text="Update current billing information" />
                            <x-billing-checkbox text="Use your personal information" />
                        </div>
                        <div class="grid space-y-2">
                            <x-billing-checkbox text="Update current address information" />
                            <x-billing-checkbox text="Use one of your addresses" />
                        </div>
                    </div>
                    <div class="hs-col-7 hs-align-self-center">
                        <h5 class="modal-title hs-align-self-center" style="color: black !important;"
                            id="exampleModalLabel">BILLING INFORMATION</h5>
                        <div>
                            <p>PERSONAL INFORMATION</p>
                        </div>
                        <div class="hs-row">
                            <!-- Name Input -->
                            <div class="hs-col-md-8">
                                <div class="hs-form-group">
                                    <label for="name" class="hs-form-control-label">Name</label>
                                    <input
                                        class="hs-form-control @error('name') hs-is-invalid @enderror"
                                        type="text" wire:model.defer="name"
                                        value="{{ old('name', $userBillingInfo->name) }}">
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
                                        value="{{ old('nif', $userBillingInfo->nif) }}">
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
                                        value="{{ old('email', $userBillingInfo->email) }}">
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
                                        value="{{ old('phone', $userBillingInfo->phone) }}">
                                    @error('phone')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
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
                            <div class="hs-d-flex hs-justify-content-end">
                                <button id="create-billing-info-button" type="submit"
                                        class="hs-btn hs-btn-sm hs-ms-auto hs-col-md-4"
                                        style="border: 1px solid #437546; background-color: #E0EBDC;">
                                    Create
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
