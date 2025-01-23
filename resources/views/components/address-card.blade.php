<div
    class="hs-bg-white hs-p-3 hs-rounded-3 hs-d-flex hs-justify-content-between hs-flex-column z-index-0"
    style="border: 1px solid #D9D9D9; width: 350px; height: 155px; cursor: pointer;"
    id="clickableDiv{{$address->id}}">
    <div>
        <div class="hs-d-flex hs-justify-content-between">
        <span class="hs-d-flex hs-fw-bolder hs-text-uppercase"
              style="font-size: 18px"> {{ $address->pivot->addressIdentifier ?? 'none'}}
        </span>
            <livewire:fav-address :user="auth()->user()" :address="$address" />
        </div>
        <span class="hs-d-flex"> {{ $address->city }} </span>
    </div>
    <div>
        <span class="hs-d-flex"> {{ $address->zipcode }} </span>
        <span class="hs-d-flex"> {{ $address->street }} </span>
    </div>
</div>
@push('js')
    <script>
        document.getElementById('clickableDiv{{$address->id}}').addEventListener('click', function () {
            let modal = new bootstrap.Modal(document.getElementById('addressModal{{$address->id}}'));
            modal.show();
        });

        document.getElementById('favAddress{{$address->id}}').addEventListener('click', function (event) {
            event.stopPropagation();
        });
    </script>
@endpush
