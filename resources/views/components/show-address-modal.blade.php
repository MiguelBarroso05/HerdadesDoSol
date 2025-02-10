<div class="modal fade" id="addressModal{{$address->id}}" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%; z-index: 9999 !important;">
        <div class="modal-content">
            <div class="hs-d-flex hs-justify-content-end div-close">
                <x-custom-button type="close" route="{{null}}"/>
            </div>
            <div class="hs-col-10 hs-align-self-center">
                <div class="modal-body">
                    <div class="hs-d-flex hs-justify-content-between hs-mb-md-4">
                        <h5 class="modal-title hs-align-self-center hs-text-uppercase" style="color: black !important;"
                            id="exampleModalLabel">{{$address->pivot->addressIdentifier}} ADDRESS</h5>
                        <div class="hs-d-flex hs-align-items-center">
                            <a id="openEditAddressModal{{$address->id}}" class="mx-2"><i
                                    class="bi bi-pencil-square hs-fs-5" style="color: #2B6EFF; cursor: pointer"></i></a>
                            <button id="openDeletionModal{{$address->id}}" type="button" class="mx-2"
                                    style="border: none; background-color: transparent">
                                <i class="bi bi-trash hs-fs-5" style="color: red"></i>
                            </button>
                        </div>
                    </div>
                    <div class="hs-row">
                        <div class="hs-col-md-6 hs-d-flex">
                            <p><strong>Identifier:</strong> {{ $address->pivot->addressIdentifier ?? 'none' }}</p>
                        </div>
                        <div class="hs-col-md-6">
                            <p><strong>Phone Number:</strong> {{ $address->pivot->addressPhone ?? 'none' }}</p>
                        </div>
                        <div class="hs-col-md-6">
                            <p><strong>Country:</strong> {{ $address->country }}</p>
                        </div>
                        <div class="hs-col-md-6">
                            <p><strong>City:</strong> {{ limit_word($address->city, 35, false) }}</p>
                        </div>
                        <div class="hs-col-md-6">
                            <p><strong>Zipcode:</strong> {{ $address->zipcode }}</p>
                        </div>
                        <div class="hs-col-md-6">
                            <p><strong>Street:</strong> {{ limit_word($address->street, 35, false) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-confirm-deletion modalId="confirmDeletion{{$address->id}}"
                    title="CONFIRM DELETION"
                    message="Are you sure you want to delete {{$address->pivot->addressIdentifier}} address?"
                    route="{{route('users.destroyUserAddress', ['user'=>$user, 'address'=>$address])}}"
                    prevModalId="addressModal{{$address->id}}"/>

<livewire:edit-address-form
    :user="$user"
    :address="$address"/>
@push('js')
    <script>
        document.getElementById('openDeletionModal{{$address->id}}').addEventListener('click', function () {
            let deletionModal = new bootstrap.Modal(document.getElementById('confirmDeletion{{$address->id}}'));

            let addressModalElement = document.getElementById('addressModal{{$address->id}}');
            let showAddressModal = bootstrap.Modal.getInstance(addressModalElement);

            if (showAddressModal) {
                showAddressModal.hide();
            }
            deletionModal.show();
        });

        document.getElementById('openEditAddressModal{{$address->id}}').addEventListener('click', function () {
            let editAddressModal = new bootstrap.Modal(document.getElementById('editAddress{{$address->id}}'));
            editAddressModal.show();
        });
    </script>
@endpush
