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
                            <p>PERSONAL INFORMATION</p>
                        </div>
                        <div class="hs-row">
                            <!-- Name Input -->
                            <div class="hs-col-md-8">
                                <div class="hs-form-group">
                                    <label for="name" class="hs-form-control-label">Name</label>
                                    <input
                                        class="hs-form-control @error('name') is-invalid @enderror"
                                        type="text" wire:model.defer="name"
                                        placeholder="Name">
                                    @error('name')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- NIF Input -->
                            <div class="hs-col-md-4">
                                <div class="hs-form-group">
                                    <label for="nif" class="hs-form-control-label">NIF</label>
                                    <input
                                        class="hs-form-control @error('nif') is-invalid @enderror"
                                        type="text" wire:model.defer="nif"
                                        placeholder="NIF">
                                    @error('nif')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Email Input -->
                            <div class="hs-col-md-8">
                                <div class="hs-form-group">
                                    <label for="email" class="hs-form-control-label">Email</label>
                                    <input
                                        class="hs-form-control @error('email') is-invalid @enderror"
                                        type="text" wire:model.defer="email"
                                        placeholder="Email">
                                    @error('email')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Phone Number Input -->
                            <div class="hs-col-md-4">
                                <div class="hs-form-group">
                                    <label for="phone" class="hs-form-control-label">Phone Number</label>
                                    <input
                                        class="hs-form-control @error('phone') is-invalid @enderror"
                                        type="text" wire:model.defer="phone"
                                        placeholder="+000 000 000 000">
                                    @error('phone')
                                    <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="hs-d-flex hs-justify-content-end">
                            <x-custom-button id="create-billing-info-button" type="create" route="{{null}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
