@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Estate'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="col-admin">
        <div class="hs-container-fluid ">
            <div class="hs-row place-content-center">
                <div class="hs-col-md-5">
                    <!-- Estate Edit Form -->
                    <div class="hs-card">
                        <form action="{{ route('estates.store') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <!-- Form Header -->
                            <div class="hs-card-header hs-pb-0 rounded-2xl">
                                <div class="hs-d-flex hs-align-items-center justify-between">
                                    <p class="hs-mb-0">Create Estate</p>
                                    <x-custom-button type="cancelIcon" route="{{url()->previous()}}"/>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- Estate Information Section -->
                                <div class="hs-row">
                                    <!-- Name input -->
                                    <div class="hs-col-md-5">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Estate
                                                Name</label>
                                            <input class="hs-form-control @error('name') hs-is-invalid @enderror" type="text" name="name" placeholder="Name"
                                                   value="{{ old('name') }}">
                                            @error('name')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Profile Image Upload -->
                                    <div class="hs-col-md-5">
                                        <label for="img" class="hs-form-control-label">Image</label>
                                        <input type="file" class="hs-form-control @error('img') hs-is-invalid @enderror" name="img"
                                               id="estateImageInput"
                                               accept="image/*">
                                        @error('img')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr class="hs-horizontal hs-dark">

                                <p class="hs-text-uppercase hs-text-sm">Address Information</p>
                                <div class="hs-row">
                                    <!-- Country input -->
                                    <div class="hs-col-md-5">
                                        <div class="hs-form-group">
                                            <label for="country"
                                                   class="hs-form-control-label">Country</label>
                                            <input
                                                class="hs-form-control @error('country') hs-is-invalid @enderror"
                                                name="country" type="text"
                                                placeholder="Name"
                                                value="{{ old('country') }}">
                                            @error('country')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City input -->
                                    <div class="hs-col-md-5">
                                        <div class="hs-form-group">
                                            <label for="city" class="hs-form-control-label">City</label>
                                            <input
                                                class="hs-form-control @error('city') hs-is-invalid @enderror"
                                                name="city" type="text"
                                                placeholder="Name"
                                                value="{{ old('city') }}">
                                            @error('city')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <!-- Street input -->
                                    <div class="hs-col-md-5">
                                        <div class="hs-form-group">
                                            <label for="street"
                                                   class="hs-form-control-label">Street</label>
                                            <input
                                                class="hs-form-control @error('street') hs-is-invalid @enderror"
                                                name="street" type="text"
                                                placeholder="Name"
                                                value="{{ old('street') }}">
                                            @error('street')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Zipcode input -->
                                    <div class="hs-col-md-5">
                                        <div class="hs-form-group">
                                            <label for="zipcode"
                                                   class="hs-form-control-label">Zipcode</label>
                                            <input
                                                class="hs-form-control @error('zipcode') hs-is-invalid @enderror"
                                                name="zipcode" type="text"
                                                placeholder="Name"
                                                value="{{ old('zipcode') }}">
                                            @error('zipcode')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <x-custom-button type="create" route="{{null}}"/>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Side Image Section -->
                <div class="hs-col-md-4">
                    <img src="{{ asset('/imgs/users/no-image.png') }}"
                         id="estateImage" class="w-auto h-[472px]"
                         style="object-fit: cover; border-radius: 24px;">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.getElementById('estateImageInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('estateImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush


