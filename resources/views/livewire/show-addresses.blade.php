<div>
    <p class="text-secondary">ADDRESS INFORMATION</p>
    <div class="hs-row hs-mx-auto hs-justify-content-between" style="min-height: 155px;">
        @foreach($addresses as $address)
            <div
                class="hs-bg-white hs-p-3 hs-rounded-3 hs-d-flex hs-justify-content-between hs-flex-column z-index-0"
                style="border: 1px solid #D9D9D9; width: 350px; height: 155px; cursor: pointer;"
                id="clickableDiv{{$address->id}}">
                <div>
                    <div class="hs-d-flex hs-justify-content-between">
                        <span class="hs-d-flex hs-fw-bolder hs-text-uppercase"
                              style="font-size: 18px"> {{ $address->pivot->addressIdentifier ?? 'none'}}
                        </span>
                        <div>
                            <span wire:click="toggleFavorite({{ $address->id }})" id="favAddress{{$address->id}}"
                                  class="cursor-pointer">
                                @if($address->pivot->isFavorite)
                                    <i class="bi bi-star-fill hs-fs-5" style="color: #FFB427;"></i>
                                @else
                                    <i class="bi bi-star hs-fs-5" style="color: #FFB427;"></i>
                                @endif
                            </span>
                        </div>
                    </div>
                    <span class="hs-d-flex"> {{ $address->city }} </span>
                </div>
                <div>
                    <span class="hs-d-flex"> {{ $address->zipcode }} </span>
                    <span class="hs-d-flex"> {{ limit_word($address->street, 35, false) }} </span>
                </div>
            </div>
            @push('js')
                <script>
                    document.getElementById('favAddress{{$address->id}}').addEventListener('click', function (event) {
                        event.stopPropagation();
                    });
                </script>
            @endpush
        @endforeach
        @if(auth()->user()->addresses->count() < 3)
            <button type="button"
                    class="hs-bg-white hs-p-3 hs-rounded-3 hs-d-flex hs-justify-content-center hs-align-items-center hs-fs-2"
                    style="border: 1px dashed  #437546; width: 350px; height: 155px; color: #437546;"
                    data-bs-toggle="modal"
                    data-bs-target="#clientAddAddressModal">
                <i class="bi bi-plus-circle hs-fw-bolder"></i>
            </button>
        @endif
        @if(auth()->user()->addresses->count() == 0)
            <div class="hs-text-center hs-align-content-center" style="width: 350px; height: 155px;">
                Consider adding your preferred location to simplify your purchases
            </div>
            <div class="hs-ms-2" style="width: 350px; height: 155px;"></div>

        @elseif(auth()->user()->addresses->count() != 0)
            @for ($i = auth()->user()->addresses->count(); $i < 2; $i++)
                <div class="hs-ms-2" style="width: 350px; height: 155px;"></div>
            @endfor
        @endif
    </div>
</div>
