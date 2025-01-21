@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('{{$modalIdName}}'));
            modal.show();
        });
    </script>
@endif
<form method="POST" action="{{ route('users.storeAddress', $user) }}" id="addressForm">
    @csrf
    @method('PUT')
    <div class="hs-modal-content">
        <div class="hs-d-flex hs-ps-5 hs-pe-3 hs-py-2 hs-justify-content-between hs-rounded-3" style="background-color: #D4D4D4;">
            <h5 class="hs-modal-title hs-align-self-center" style="color: black !important;" id="exampleModalLabel">NEW ADDRESS</h5>
            <a type="button" data-bs-dismiss="modal" aria-label="Close">
                <i class="hs-bi hs-bi-x hs-fs-3" style="color: black !important; font-weight:800 !important;"></i>
            </a>
        </div>
        <div class="hs-col-10 hs-align-self-center">
            <div class="hs-modal-body">
                <div class="hs-row">
                    <!-- Identifier Input -->
                    <div class="hs-col-md-4">
                        <div class="hs-form-group">
                            <label for="addressIdentifier" class="hs-form-control-label">Identifier</label>
                            <input
                                class="hs-form-control @error('addressIdentifier') hs-is-invalid @enderror"
                                type="text" name="addressIdentifier"
                                placeholder="Home"
                                value="{{ old('addressIdentifier') }}">
                            @error('addressIdentifier')
                            <div class="hs-invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone Number Input -->
                    <div class="hs-col-md-4">
                        <div class="hs-form-group">
                            <label for="addressPhone" class="hs-form-control-label">Phone Number</label>
                            <input
                                class="hs-form-control @error('addressPhone') hs-is-invalid @enderror"
                                type="text" name="addressPhone"
                                placeholder="+000 000 000 000"
                                value="{{ old('addressPhone') }}">
                            @error('addressPhone')
                            <div class="hs-invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Country Input -->
                    <div class="hs-col-md-4">
                        <div class="hs-form-group">
                            <label for="address[country]" class="hs-form-control-label">Country</label>
                            <input
                                class="hs-form-control @error('address.country') hs-is-invalid @enderror"
                                name="address[country]" type="text"
                                placeholder="Name"
                                value="{{ old('address[country]') }}">
                            @error('address.country')
                            <div class="hs-invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- City Input -->
                    <div class="hs-col-md-8">
                        <div class="hs-form-group">
                            <label for="address[city]" class="hs-form-control-label">City</label>
                            <input
                                class="hs-form-control @error('address.city') hs-is-invalid @enderror"
                                placeholder="Name"
                                type="text" name="address[city]"
                                value="{{ old('address[city]') }}">
                            @error('address.city')
                            <div class="hs-invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Zipcode Input -->
                    <div class="hs-col-md-4">
                        <div class="hs-form-group">
                            <label for="address[zipcode]" class="hs-form-control-label">Zipcode</label>
                            <input
                                class="hs-form-control @error('address.zipcode') hs-is-invalid @enderror"
                                type="text" name="address[zipcode]"
                                placeholder="0000-000"
                                value="{{ old('address[zipcode]') }}">
                            @error('address.zipcode')
                            <div class="hs-invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Street Input -->
                    <div class="hs-col-md-12">
                        <div class="hs-form-group">
                            <label for="address[street]" class="hs-form-control-label">Street</label>
                            <input
                                class="hs-form-control @error('address.street') hs-is-invalid @enderror"
                                type="text" name="address[street]"
                                placeholder="Name, number, floor"
                                value="{{ old('address[street]') }}">
                            @error('address.street')
                            <div class="hs-invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-custom-button type="create" route="{{null}}"/>
            </div>
        </div>
    </div>
</form>
