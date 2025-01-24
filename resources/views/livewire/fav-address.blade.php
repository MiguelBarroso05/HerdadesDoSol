<div>
    <span wire:click="toggleFavorite" id="favAddress{{ $addressId }}" class="cursor-pointer">
        @if($isFavorite)
            <i class="bi bi-star-fill hs-fs-5" style="color: #FFB427;"></i>
        @else
            <i class="bi bi-star hs-fs-5" style="color: #FFB427;"></i>
        @endif
    </span>
</div>

