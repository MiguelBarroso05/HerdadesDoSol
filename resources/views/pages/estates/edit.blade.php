@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Estate'])

    <div class="col-admin">
        <!-- Estate Card Section -->
        <div class="hs-card hs-shadow-lg hs-mx-4 hs-card-profile-bottom">
            <div class="hs-card-body hs-p-3">
                <div class="hs-row hs-gx-4">
                    <!-- Estate name -->
                    <div class="hs-col-auto hs-my-auto">
                        <div class="hs-h-100">
                            <h5 class="hs-mb-1">
                                {{ $estate->name}}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row place-content-center">
                <div class="hs-col-md-6">
                    <!-- Estate Edit Form -->
                    <div class="hs-card">
                        <form role="form" method="POST"
                              action={{ route('estates.update', $estate->id) }} enctype="multipart/form-data">
                            @csrf <!-- CSRF token for security -->

                            <!-- Form Header -->
                            <div class="hs-card-header hs-pb-0 rounded-2xl">
                                <div class="hs-d-flex hs-align-items-center justify-between">
                                    <p class="hs-mb-0">Edit Estate</p>
                                    <div class="hs-col-6 text-end">
                                        <!-- Submit button -->
                                        <x-custom-button type="update" route="{{null}}"/>

                                        <x-custom-button type="cancel" route="{{ route('estates.index') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- Estate Information Section -->
                                <div class="hs-row">
                                    <!-- Name input -->
                                    <div class="hs-col-md-4">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">Estate
                                                Name</label>
                                            <input class="hs-form-control" type="text" name="name"
                                                   value="{{ old('name', $estate->name) }}">
                                        </div>
                                    </div>

                                    <!-- Profile Image Upload -->
                                    <div class="hs-col-md-4">
                                        <label for="img" class="hs-form-control-label">Image</label>
                                        <input type="file" class="hs-form-control" name="img" id="inputGroupFile02"
                                               accept="image/*">
                                    </div>
                                </div>
                                <hr class="hs-horizontal hs-dark">

                                <p class="hs-text-uppercase hs-text-sm">Address Information</p>
                                <div class="hs-row">
                                    <!-- Country input -->
                                    <div class="hs-col-md-4">
                                        <div class="hs-form-group">
                                            <label for="country" class="hs-form-control-label">Country</label>
                                            <input
                                                class="hs-form-control @error('country') hs-is-invalid @enderror"
                                                name="country" type="text"
                                                placeholder="Name"
                                                value="{{ old('country', $estate->address->country) }}">
                                            @error('country')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City input -->
                                    <div class="hs-col-md-4">
                                        <div class="hs-form-group">
                                            <label for="city" class="hs-form-control-label">City</label>
                                            <input
                                                class="hs-form-control @error('city') hs-is-invalid @enderror"
                                                name="city" type="text"
                                                placeholder="Name"
                                                value="{{ old('city', $estate->address->city) }}">
                                            @error('city')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <!-- Street input -->
                                    <div class="hs-col-md-4">
                                        <div class="hs-form-group">
                                            <label for="street" class="hs-form-control-label">Street</label>
                                            <input
                                                class="hs-form-control @error('street') hs-is-invalid @enderror"
                                                name="street" type="text"
                                                placeholder="Name"
                                                value="{{ old('street', $estate->address->street) }}">
                                            @error('street')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Zipcode input -->
                                    <div class="hs-col-md-4">
                                        <div class="hs-form-group">
                                            <label for="zipcode" class="hs-form-control-label">Zipcode</label>
                                            <input
                                                class="hs-form-control @error('zipcode') hs-is-invalid @enderror"
                                                name="address[zipcode]" type="text"
                                                placeholder="Name"
                                                value="{{ old('address[zipcode]', $estate->address->zipcode) }}">
                                            @error('address.zipcode')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Side Image Section -->
                <div class="hs-col-md-4">
                        <img src="{{ $estate->img ? asset('storage/'.$estate->img) : asset('/imgs/users/no-image.png') }}" class="w-auto h-[440px]"
                             style="object-fit: cover; border-radius: 24px;">
                </div>
            </div>
        </div>
    </div>
@endsection
