@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Estate'])

    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-col-md-8">
                    <!-- Error Messages -->
                    <x-general-errors/>

                    <!-- User Information Card -->
                    <div class="hs-card">
                        <form action="{{ route('estates.store',) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Create Estate</p>
                                    <!-- Action Buttons -->
                                    <div>
                                        <!-- Create button -->
                                        <x-custom-button type="create" route={{null}}/>
                                        <!-- Cancel button-->
                                        <x-custom-button type="cancel" route="{{ route('estates.index') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- Mandatory Information Section -->
                                <p class="hs-text-uppercase hs-text-sm">Estate Information</p>
                                <div class="hs-row">
                                    <!-- Name Input -->
                                    <div class="hs-col-md-12">
                                        <div class="hs-form-group">
                                            <label for="name" class="hs-form-control-label">Estate Name</label>
                                            <input class="hs-form-control @error('email') hs-is-invalid @enderror" type="text"
                                                   name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!--  Information Section -->
                                    <hr>
                                    <p class="hs-text-uppercase hs-text-sm">Address Information</p>

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
                            </div>
                        </form>
                    </div>
                </div>
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


