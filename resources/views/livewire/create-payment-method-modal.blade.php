<div wire:ignore.self class="modal fade" id="{{ $modalIdName }}" tabindex="-1"
    @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 20%">
        <form wire:submit.prevent="submit">
            <div class="modal-content" style="width: 440px;">
                <div class="hs-d-flex hs-justify-content-end div-close">
                    <x-custom-button type="close" route="{{ null }}" />
                </div>
                <div class="hs-col-10 hs-align-self-center">
                    <div class="modal-body">
                        <div class="hs-d-flex hs-justify-content-between hs-mb-md-4">
                            <h5 class="modal-title hs-align-self-center" id="exampleModalLabel">Payment Method</h5>
                        </div>
                        <div class="hs-row hs-justify-content-center">
                            <div class="hs-row hs-d-flex hs-justify-content-between hs-mb-3">
                                <!-- Identifier Input -->
                                <div class="hs-col-md-7">
                                    <div class="form-group">
                                        <label for="identifier" class="hs-form-control-label">Identifier</label>
                                        <input class="hs-form-control @error('identifier') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="identifier" placeholder="Name">
                                        @error('identifier')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Type Input -->
                                <div class="hs-col-md-5">
                                    <div class="form-group" wire:ignore>
                                        <label for="payment_method_type_id" class="hs-form-control-label">Type</label>
                                        <x-payment-method-type-dropdown />
                                        @error('payment_method_type_id')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="hs-row hs-d-flex hs-justify-content-between hs-mb-3">
                                <!-- Name Input -->
                                <div class="hs-col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="hs-form-control-label">Name*</label>
                                        <input class="hs-form-control @error('name') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="name" placeholder="Name & Surname">
                                        @error('name')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Validity Input -->
                                <div class="hs-col-md-4">
                                    <div class="form-group">
                                        <label for="validity" class="hs-form-control-label">Validity*</label>
                                        <input class="hs-form-control @error('validity') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="validity"
                                            oninput="this.value = this.value
                                            .replace(/[^0-9]/g, '')
                                            .replace(/(\d{2})(\d{0,2})/, (match, mm, yy) => {
                                                yy = yy.substring(0, 2);
                                                return yy ? `${mm}/${yy}` : mm;
                                            })
                                            .substring(0, 5)"
                                            placeholder="mm/YY" maxlength="5">
                                        @error('validity')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="hs-row hs-d-flex hs-justify-content-between hs-mb-3">
                                <!-- Number Input -->
                                <div class="hs-col-md-8">
                                    <div class="form-group">
                                        <label for="number" class="hs-form-control-label">Number*</label>
                                        <input class="hs-form-control @error('number') hs-is-invalid @enderror"
                                            type="text" wire:model.defer="number"
                                            oninput="this.value = this.value
                                                .replace(/[^0-9]/g, '')
                                                .replace(/(\d{4})(?=\d)/g, '$1 ')
                                                .substring(0, 19)"
                                            placeholder="xxxx xxxx xxxx xxxx" maxlength="19">



                                        @error('number')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="hs-row" style="text-align: center;">
                                <p style="font-size: 12px;">All fields marked with an asterisk (*) are mandatory. <br>
                                    Your information is encrypted and protected</p>
                            </div>
                        </div>
                        <div class="hs-d-flex hs-justify-content-center">
                            <x-custom-button type="create" route="{{ null }}" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
