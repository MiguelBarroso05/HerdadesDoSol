<div wire:ignore.self class="modal fade" id="chooseExistentAddress" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered"
         @if($user->addresses->count() == 2) style="max-width: 700px;"
         @else style="max-width: 980px;"@endif>
        <form wire:submit="submit">
            <div class="modal-content">
                <div class="hs-d-flex hs-justify-content-end div-close">
                    <x-custom-button type="close" route="{{null}}"/>
                </div>
                <div class="modal-body hs-px-6">
                    <h5 class="modal-title hs-mb-md-4" id="exampleModalLabel">BILLING INFORMATION</h5>
                    <div class="hs-row hs-d-flex hs-justify-content-between hs-mb-3">
                        <p>ADDRESS INFORMATION</p>
                        @foreach($addresses as $address)
                            <div class="radio-address hs-bg-white hs-p-3 hs-rounded-3 hs-d-flex hs-justify-content-between hs-flex-column z-index-0
                            {{ $address->id == $addressId ? 'active' : '' }}"
                                 style="border: 1px solid #D9D9D9; width: 280px; height: 155px; cursor: pointer;"
                                 id="radioDiv{{$address->id}}"
                                 wire:click="selectAddress({{ $address->id }})"
                                 >
                                <div>
                                    <div class="hs-d-flex hs-justify-content-between">
                                        <span class="hs-d-flex hs-fw-bolder hs-text-uppercase" style="font-size: 18px">
                                            {{ $address->pivot->addressIdentifier ?? 'none'}}
                                        </span>
                                    </div>
                                    <span class="hs-d-flex"> {{ $address->city }} </span>
                                </div>
                                <div>
                                    <span class="hs-d-flex"> {{ $address->zipcode }} </span>
                                    <span class="hs-d-flex"> {{ $address->street }} </span>
                                </div>
                            </div>
                            <input type="radio" wire:model="addressId" name="selectedAddress" value="{{$address->id}}"
                                   id="radio{{$address->id}}" style="display: none;">
                        @endforeach
                    </div>
                    <div class="hs-d-flex hs-justify-content-end">
                        <x-custom-button type="create" route="{{null}}"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
