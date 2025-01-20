@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <!-- Include the top navigation bar with the title "Profile" -->
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Estate'])


    <!-- Edit Form -->
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Error Messages -->
                <x-general-errors/>

                <!-- User Information Card -->
                <div class="card">
                    <form action="{{ route('estates.store',) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Create Estate</p>
                                <!-- Action Buttons -->
                                <div>
                                    <!-- Create button -->
                                    <x-custom-button type="create" route={{null}}/>
                                    <!-- Cancel button-->
                                    <x-custom-button type="cancel" route="{{ route('estates.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Mandatory Information Section -->
                            <p class="text-uppercase text-sm">Estate Information</p>
                            <div class="row">
                                <!-- Name Input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Estate Name</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text"
                                               name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!--  Information Section -->
                                <hr>
                                <p class="text-uppercase text-sm">Address Information</p>

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
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @push('js')
        <script>
            document.getElementById('inputGroupFile02').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('profilePreview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection




