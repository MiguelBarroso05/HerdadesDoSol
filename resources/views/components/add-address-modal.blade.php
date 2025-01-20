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
    <div class="modal-content">
        <div class="d-flex ps-5 pe-3 py-2 justify-content-between rounded-3" style="background-color: #D4D4D4;">
            <h5 class="modal-title align-self-center" style="color: black !important;" id="exampleModalLabel">NEW
                ADDRESS</h5>
            <a type="button" data-bs-dismiss="modal" aria-label="Close">
                <i class="bi bi-x fs-3" style="color: black !important; font-weight:800 !important;"></i>
            </a>
        </div>
        <div class="col-10 align-self-center">
            <div class="modal-body">
                <div class="row">
                    <!-- Identifier Input -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="addressIdentifier" class="form-control-label">Identifier</label>
                            <input
                                class="form-control @error('addressIdentifier') is-invalid @enderror"
                                type="text" name="addressIdentifier"
                                placeholder="Home"
                                value="{{ old('addressIdentifier') }}">
                            @error('addressIdentifier')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone Number Input -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="addressPhone" class="form-control-label">Phone Number</label>
                            <input
                                class="form-control @error('addressPhone') is-invalid @enderror"
                                type="text" name="addressPhone"
                                placeholder="+000 000 000 000"
                                value="{{ old('addressPhone') }}">
                            @error('addressPhone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Country Input -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address[country]" class="form-control-label">Country</label>
                            <input
                                class="form-control @error('address.country') is-invalid @enderror"
                                name="address[country]" type="text"
                                placeholder="Name"
                                value="{{ old('address[country]') }}">
                            @error('address.country')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- City Input -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="address[city]" class="form-control-label">City</label>
                            <input
                                class="form-control @error('address.city') is-invalid @enderror"
                                placeholder="Name"
                                type="text" name="address[city]"
                                value="{{ old('address[city]') }}">
                            @error('address.city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Zipcode Input -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address[zipcode]" class="form-control-label">Zipcode</label>
                            <input
                                class="form-control @error('address.zipcode') is-invalid @enderror"
                                type="text" name="address[zipcode]"
                                placeholder="0000-000"
                                value="{{ old('address[zipcode]') }}">
                            @error('address.zipcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Street Input -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address[street]" class="form-control-label">Street</label>
                            <input
                                class="form-control @error('address.street') is-invalid @enderror"
                                type="text" name="address[street]"
                                placeholder="Name, number, floor"
                                value="{{ old('address[street]') }}">
                            @error('address.street')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-custom-button type="create" route="{{null}}"/>
            </div>
        </div>
    </div>
</form>
