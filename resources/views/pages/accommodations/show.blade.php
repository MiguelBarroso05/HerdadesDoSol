@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'accommodation'])

    <!-- Profile Card Section -->
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <!-- accommodation image -->
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $accommodation->accommodation_types->img ? asset('storage/'.$accommodation->accommodation_types->img) : asset('/imgs/users/no-image.png') }}"
                             alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <!-- accommodation id -->
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Accommodation #{{ $accommodation->id }}
                        </h5>
                    </div>
                </div>
                <!-- Buttons aligned to the right and vertically centered -->
                <div class="col d-flex align-items-center justify-content-end">
                    <!-- Edit button-->
                    <x-custom-button type="edit" route="{{ route('accommodations.edit', $accommodation) }}"/>
                    <!-- Cancel -->
                    <x-custom-button type="cancel" route="{{ route('accommodations.index') }}"/>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- accommodation Information Section -->
            <div class="col-md-8">
                <div class="card h-100 d-flex flex-column justify-content-center">
                    <div class="card-header pb-0">
                        <h6>Accommodation Information</h6>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="w-100">
                            <p class="text-uppercase text-sm">Basic Information</p>
                            <div class="row">
                                <!-- Id -->
                                <div class="col-md-6">
                                    <p><strong>Id:</strong> {{ $accommodation->id }}</p>
                                </div>
                                <!-- Type -->
                                <div class="col-md-6">
                                    <p><strong>Type:</strong> {{ $accommodation->accommodation_types->name }}</p>
                                </div>
                                <!-- Size -->
                                <div class="col-md-6">
                                    <p><strong>Size</strong> {{ $accommodation->size }}</p>
                                </div>
                                <!-- Description -->
                                <div class="col-md-6">
                                    <p><strong>Description:</strong> {{ $accommodation->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side Image Section -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('imgs/pages/placeholder.jpg') }}" class="w-100 h-100"
                         style="object-fit: cover; border-radius: 24px;">
                </div>
            </div>
        </div>
    </div>
@endsection
