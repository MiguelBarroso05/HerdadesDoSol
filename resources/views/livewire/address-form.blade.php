<div wire:ignore.self class="modal fade" id="{{$modalIdName}}" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%">
        <form wire:submit.prevent="submit">
            <div class="modal-content">
                <div class="col-10 align-self-center">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="modal-title align-self-center" style="color: black !important;"
                                id="exampleModalLabel">NEW ADDRESS</h5>
                            <a type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x fs-3" style="color: black !important;"></i>
                            </a>
                        </div>
                        <div class="row">
                            <!-- Identifier Input -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="addressIdentifier" class="form-control-label">Identifier</label>
                                    <input
                                        class="form-control @error('addressIdentifier') is-invalid @enderror"
                                        type="text" wire:model.defer="addressIdentifier"
                                        placeholder="Home">
                                    @error('addressIdentifier')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Phone Number Input -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="addressPhone" class="form-control-label">Phone Number</label>
                                    <input
                                        class="form-control @error('addressPhone') is-invalid @enderror"
                                        type="text" wire:model.defer="addressPhone"
                                        placeholder="+000 000 000 000">
                                    @error('addressPhone')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Country Input -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address[country]" class="form-control-label">Country</label>
                                    <input
                                        class="form-control @error('address.country') is-invalid @enderror"
                                        type="text" wire:model.defer="address.country"
                                        placeholder="Name">
                                    @error('address.country')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- City Input -->
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="address[city]" class="form-control-label">City</label>
                                    <input
                                        class="form-control @error('address.city') is-invalid @enderror"
                                        type="text" wire:model.defer="address.city"
                                        placeholder="Name">
                                    @error('address.city')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Zipcode Input -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address[zipcode]" class="form-control-label">Zipcode</label>
                                    <input
                                        class="form-control @error('address.zipcode') is-invalid @enderror"
                                        type="text" wire:model.defer="address.zipcode"
                                        placeholder="0000-000">
                                    @error('address.zipcode')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Street Input -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address[street]" class="form-control-label">Street</label>
                                    <input
                                        class="form-control @error('address.street') is-invalid @enderror"
                                        type="text" wire:model.defer="address.street"
                                        placeholder="Name, number, floor">
                                    @error('address.street')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
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
