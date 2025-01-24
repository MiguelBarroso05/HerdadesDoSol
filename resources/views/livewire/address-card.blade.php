<div class="hs-bg-white hs-p-3 hs-rounded-3 hs-d-flex hs-justify-content-between hs-flex-column z-index-0"
     style="border: 1px solid #D9D9D9; width: 350px; height: 155px; cursor: pointer;" id="clickableDiv{{$address->id}}">
    <div>
        <div class="hs-d-flex hs-justify-content-between">
            <span class="hs-d-flex hs-fw-bolder hs-text-uppercase" style="font-size: 18px">
                {{ $address->pivot->addressIdentifier ?? 'none'}}
            </span>
            <div>
                <span wire:click="toggleFavorite" id="favAddress{{$address->id}}" class="cursor-pointer">
                    @if($isFavorite)
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
        <span class="hs-d-flex"> {{ $address->street }} </span>
    </div>
</div>
