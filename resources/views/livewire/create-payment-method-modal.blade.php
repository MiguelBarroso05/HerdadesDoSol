<div wire:ignore.self class="modal fade" id="{{$modalIdName}}" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 20%">
        <form wire:submit.prevent="submit">
            <div class="modal-content" style="width: 440px;">
                <div class="hs-d-flex hs-justify-content-end div-close">
                    <x-custom-button type="close" route="{{null}}"/>
                </div>
                <div class="hs-col-10 hs-align-self-center">
                    <div class="modal-body">
                        <div class="hs-d-flex hs-justify-content-between hs-mb-md-4">
                            <h5 class="modal-title hs-align-self-center"
                                id="exampleModalLabel">Payment Method</h5>
                        </div>
                        <div class="hs-row hs-justify-content-center">
                            <div class="hs-row hs-d-flex hs-justify-content-between hs-mb-3">
                                <!-- Identifier Input -->
                                <div class="hs-col-md-8">
                                    <div class="form-group">
                                        <label for="identifier" class="hs-form-control-label">Identifier</label>
                                        <input
                                            class="hs-form-control @error('identifier') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="identifier"
                                            placeholder="Name">
                                        @error('identifier')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- Image Template -->
                                <div class="hs-col-md-4 hs-d-flex hs-justify-content-end hs-align-items-end">
                                    <img src="{{asset('/imgs/pages/cvvIndicatorTemplate.png')}}" alt="">
                                </div>
                            </div>

                            <div class="hs-row hs-d-flex hs-justify-content-between hs-mb-3">
                                <!-- Name Input -->
                                <div class="hs-col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="hs-form-control-label">Name*</label>
                                        <input
                                            class="hs-form-control @error('name') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="name"
                                            placeholder="Name & Surname">
                                        @error('name')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- CVV Input -->
                                <div class="hs-col-md-4">
                                    <div class="form-group">
                                        <label for="cvv" class="hs-form-control-label">CVV*</label>
                                        <input
                                            class="hs-form-control @error('cvv') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="cvv"
                                            placeholder="xxx"
                                            oninput="this.value = this.value
                                       .replace(/[^0-9]/g, '')
                                       .replace(/(\d{2})(\d{1,2})?(\d{1,4})?/, (m, d, mth, y) =>
                                           [d, mth, y].filter(Boolean).join('/'));">
                                        @error('cvv')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="hs-row hs-d-flex hs-justify-content-between hs-mb-3">
                                <!-- Number Input -->
                                <div class="hs-col-md-8">
                                    <div class="form-group">
                                        <label for="number" class="hs-form-control-label">Number*</label>
                                        <input
                                            class="hs-form-control @error('number') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="number"
                                            placeholder="xxxx-xxxx-xxxx-xxxx">
                                        @error('number')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- Identifier Input -->
                                <div class="hs-col-md-4">
                                    <div class="form-group">
                                        <label for="validationDate" class="hs-form-control-label">Validity*</label>
                                        <input
                                            class="hs-form-control @error('validationDate') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="validationDate"
                                            placeholder="mm/YY">
                                        @error('validationDate')
                                        <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="hs-row" style="text-align: center;">
                                <p style="font-size: 12px;">All fields marked with an asterisk (*) are mandatory. <br> Your information is encrypted and protected</p>
                            </div>
                        </div>
                        <div class="hs-d-flex hs-justify-content-center">
                            <x-custom-button type="create" route="{{null}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

