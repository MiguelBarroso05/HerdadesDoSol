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
                                    <input
                                        class="hs-form-control @error('country') is-invalid @enderror"
                                        type="text" wire:model.defer="country"
                                        placeholder="Name">
                                    @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- City Input -->
                            <div class="hs-col-md-8">
                                <div class="hs-form-group">
                                    <label for="city" class="hs-form-control-label">City</label>
                                    <input
                                        class="hs-form-control @error('city') is-invalid @enderror"
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
                                        class="hs-form-control @error('zipcode') is-invalid @enderror"
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
                                        class="hs-form-control @error('street') is-invalid @enderror"
                                        type="text" wire:model.defer="street"
                                        placeholder="Name, number, floor">
                                    @error('street')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="hs-d-flex hs-justify-content-end">
                            <x-custom-button type="create" route="{{null}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
