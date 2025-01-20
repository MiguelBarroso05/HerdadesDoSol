<div class="modal fade" id="addressModal{{$address->id}}" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%; z-index: 9999 !important;">
        <div class="modal-content">
            <div class="col-10 align-self-center">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="modal-title align-self-center text-uppercase" style="color: black !important;"
                            id="exampleModalLabel">{{$address->pivot->addressIdentifier}} ADDRESS</h5>
                        <div class="d-flex align-items-center">
                            <x-custom-button type="fav" route="{{null}}"/>
                            <x-custom-button type="edit" route="{{null}}"/>
                            <button type="button" style="border: none; background-color: transparent"
                                    wire:click="$emit('openDeletionModal', {{ $address->id }}, {{ auth()->user()->id }})">
                                <i class="bi bi-trash fs-5" style="color: red"></i>
                            </button>
                            <x-custom-button type="close" route="{{null}}"/>
                        </div>
                    </div>
                    <livewire:confirm-deletion
                        :title="'CONFIRM DELETION'"
                        :message="'Are you sure you want to delete {{$address->pivot->addressIdentifier}} address?'"
                        :addressId="$address->id"
                        :user="auth()->user()"/>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Address Identifier:</strong> {{ $address->pivot->addressIdentifier ?? 'none' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Country:</strong> {{ $address->country }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>City:</strong> {{ $address->city }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Street:</strong> {{ $address->street }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Zipcode:</strong> {{ $address->zipcode }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address Phone:</strong> {{ $address->pivot->addressPhone ?? 'none' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('show-confirm-deletion-modal', event => {
                var modal = new bootstrap.Modal(document.getElementById('confirmDeletion'));
                modal.show();
            });

            window.addEventListener('hide-confirm-deletion-modal', event => {
                var modal = bootstrap.Modal.getInstance(document.getElementById('confirmDeletion'));
                modal.hide();
            });
        });
    </script>
@endpush
