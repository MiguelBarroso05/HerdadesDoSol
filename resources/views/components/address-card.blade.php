<div
    class="bg-white p-3 rounded-3 d-flex justify-content-between flex-column ms-2 z-index-0"
    style="border: 1px solid #D9D9D9; width: 350px; height: 155px; cursor: pointer;"
    id="clickableDiv{{$address->id}}">
    <div class="d-flex">
        <div class="col-md-10">
            <span class="d-flex fw-bolder text-uppercase"
                  style="font-size: 18px"> {{ $address->pivot->addressIdentifier ?? 'none'}} </span>
            <span class="d-flex"> {{ $address->city }} </span>
        </div>
        <div class="col-md-2 d-flex justify-content-end z-index-3">
            <x-custom-button type="fav" route="{{null}}"/>
        </div>
    </div>
    <div>
        <span class="d-flex"> {{ $address->zipcode }} </span>
        <span class="d-flex"> {{ $address->street }} </span>
    </div>
</div>
@push('js')
    <script>
        document.getElementById('clickableDiv{{$address->id}}').addEventListener('click', function () {
            let modal = new bootstrap.Modal(document.getElementById('addressModal{{$address->id}}'));
            modal.show();
        });
    </script>
@endpush
