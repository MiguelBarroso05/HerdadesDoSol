<div wire:ignore.self class="modal fade" id="{{$modalIdName}}" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%">
        <form wire:submit.prevent="submit">
            <div class="modal-content">
                <div class="hs-col-10 hs-align-self-center">
                    <div class="modal-body">
                        <div class="hs-d-flex hs-justify-content-between">
                            <h5 class="modal-title hs-align-self-center" style="color: black !important;"
                                id="exampleModalLabel">NEW ADDRESS</h5>
                            <a type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x hs-fs-3" style="color: black !important; "></i>
                            </a>
                        </div>
                        <div class="hs-row">
                            <!-- Identifier Input -->
                            <div class="hs-col-md-4">
                                <div class="form-group">
                                    <label for="addressIdentifier" class="hs-form-control-label">Identifier</label>
                                    <input
                                        class="hs-form-control @error('addressIdentifier') hs-is-invalid @enderror"
                                        type="text" wire:model.defer="addressIdentifier"
                                        placeholder="Home">
                                    @error('addressIdentifier')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Phone Number Input -->
                            <div class="hs-col-md-4">
                                <div class="hs-form-group">
                                    <label for="addressPhone" class="hs-form-control-label">Phone Number</label>
                                    <input
                                        class="hs-form-control @error('addressPhone') hs-is-invalid @enderror"
                                        type="text" wire:model.defer="addressPhone"
                                        placeholder="+000 000 000 000">
                                    @error('addressPhone')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Country Input -->
                            <div class="hs-col-md-4">
                                <div class="hs-form-group">
                                    <label for="address[country]" class="hs-form-control-label">Country</label>
                                    <input
                                        class="hs-form-control @error('address.country') hs-is-invalid @enderror"
                                        type="text" wire:model.defer="address.country"
                                        placeholder="Name">
                                    @error('address.country')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- City Input -->
                            <div class="hs-col-md-8">
                                <div class="hs-form-group">
                                    <label for="address[city]" class="hs-form-control-label">City</label>
                                    <input
                                        class="hs-form-control @error('address.city') hs-is-invalid @enderror"
                                        type="text" wire:model.defer="address.city"
                                        placeholder="Name">
                                    @error('address.city')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Zipcode Input -->
                            <div class="hs-col-md-4">
                                <div class="hs-form-group">
                                    <label for="address[zipcode]" class="hs-form-control-label">Zipcode</label>
                                    <input
                                        class="hs-form-control @error('address.zipcode') hs-is-invalid @enderror"
                                        type="text" wire:model.defer="address.zipcode"
                                        placeholder="0000-000">
                                    @error('address.zipcode')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Street Input -->
                            <div class="hs-col-md-12">
                                <div class="hs-form-group">
                                    <label for="address[street]" class="hs-form-control-label">Street</label>
                                    <input
                                        class="hs-form-control @error('address.street') hs-is-invalid @enderror"
                                        type="text" wire:model.defer="address.street"
                                        placeholder="Name, number, floor">
                                    @error('address.street')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <x-custom-button type="create" route="{{null}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
