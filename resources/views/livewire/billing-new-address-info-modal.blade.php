<div wire:ignore.self class="modal fade" id="{{$modalIdName}}" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%">
        <form wire:submit.prevent="submit">
            <div class="modal-content">
                <div class="hs-col-10 hs-align-self-center">
                    <div class="modal-body">
                        <div class="hs-d-flex hs-justify-content-between">
                            <h5 class="modal-title hs-align-self-center" style="color: black !important;"
                                id="exampleModalLabel">BILLING INFORMATION</h5>
                            <a type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x hs-fs-3" style="color: black !important;"></i>
                            </a>
                        </div>
                        <div>
                            <p>ADDRESS INFORMATION</p>
                        </div>
                        <div class="hs-row">
                            <!-- Country Input -->
                            <div class="hs-col-md-4">
                                <div class="hs-form-group">
                                    <label for="country" class="hs-form-control-label">Country</label>
                                        <x-address-country-select :user="auth()->user()" :countries='$countries'/>
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
                                        placeholder="Name">
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
                                        placeholder="0000-000">
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
                                        placeholder="Name, number, floor">
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
        </form>
    </div>
</div>

