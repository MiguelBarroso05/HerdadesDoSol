@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodation'])

    <div class="col-admin">
        <!-- Profile Card Section -->
        <div class="hs-card hs-shadow-lg mx-4 hs-card-profile-bottom">
            <div class="hs-card-body p-3">
                <div class="hs-row gx-4">
                    <!-- accommodation image -->
                    <div class="hs-col-auto">
                        <div class="hs-avatar hs-avatar-xl hs-position-relative">
                            <img src="{{ $accommodation->accommodation_types->img ? asset('storage/'.$accommodation->accommodation_types->img) : asset('/imgs/users/no-image.png') }} "
                                 alt="profile_image" class="w-100 hs-border-radius-lg hs-shadow-sm">
                        </div>
                    </div>
                    <!-- accommodation id -->
                    <div class="hs-col-auto hs-my-auto">
                        <div class="hs-h-100">
                            <h5 class="hs-mb-1">
                                Accommodation #{{ $accommodation->id }}
                            </h5>
                        </div>
                    </div>
                    <!-- Buttons aligned to the right and vertically centered -->
                    <div class="hs-col hs-d-flex hs-align-items-center hs-justify-content-end">
                        <!-- Edit button-->
                        <x-custom-button type="edit" route="{{ route('accommodations.edit', $accommodation) }}"/>
                        <!-- Cancel -->
                        <x-custom-button type="cancel" route="{{ route('accommodations.index') }}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <!-- accommodation Information Section -->
                <div class="hs-col-md-8">
                    <div class="hs-card hs-h-100 hs-d-flex hs-flex-column hs-justify-content-center">
                        <div class="hs-card-header hs-pb-0">
                            <h6>Accommodation Information</h6>
                        </div>
                        <div class="hs-card-body hs-d-flex hs-align-items-center hs-justify-content-center">
                            <div class="hs-w-100">
                                <p class="hs-text-uppercase hs-text-sm">Basic Information</p>
                                <div class="hs-row">
                                    <!-- Id -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Id:</strong> {{ $accommodation->id }}</p>
                                    </div>
                                    <!-- Type -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Type:</strong> {{ $accommodation->accommodation_types->name }}</p>
                                    </div>
                                    <!-- Size -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Size:</strong> {{ $accommodation->size }}</p>
                                    </div>
                                    <!-- Description -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Description:</strong> {{ $accommodation->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side Image Section -->
                <div class="hs-col-md-4">
                    <div class="hs-card hs-h-100">
                        <img src="{{ asset('imgs/pages/placeholder.jpg') }}" class="hs-w-100 hs-h-100"
                             style="object-fit: cover; border-radius: 24px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
