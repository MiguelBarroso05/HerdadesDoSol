@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <!-- Include the top navigation bar with the title "Activity" -->
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity'])

    <!-- Profile Card Section -->
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <!-- Activity profile image -->
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $activity->img ? asset('/storage/'.$activity->img) : asset('/imgs/users/no-image.png') }}" alt="activity_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <!-- Activity name -->
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $activity->name }}
                        </h5>
                    </div>
                </div>
                <!-- Buttons aligned to the right and vertically centered -->
                <div class="col d-flex align-items-center justify-content-end">
                    <!-- Edit button -->
                    <x-custom-button type="edit" route="{{ route('activities.edit', $activity) }}"/>
                    <!-- Cancel button -->
                    <x-custom-button type="cancel" route="{{ route('activities.index') }}"/>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Information Card -->
            <div class="col-md-8">
                <div class="card h-100 d-flex flex-column justify-content-center">
                    <div class="card-header pb-0">
                        <h6>Activity Information</h6>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <div class="w-100">
                            <p class="text-uppercase text-sm">Basic Information</p>
                            <div class="row">
                                <!-- Activity Name -->
                                <div class="col-md-6">
                                    <p><strong>Activity Name:</strong> {{ $activity->name }}</p>
                                </div>
                                <!-- Description -->
                                <div class="col-md-6">
                                    <p><strong>Description:</strong> {{ $activity->description }}</p>
                                </div>
                                <!-- Type -->
                                <div class="col-md-6">
                                    <p><strong>Type:</strong> {{ $activity->activity_types->name ?? 'none' }}</p>
                                </div>
                                <!-- Created At -->
                                <div class="col-md-6">
                                    <p><strong>Created At:</strong> {{ $activity->created_at ? $activity->created_at->format('d/m/Y') : 'none' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Image Section -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('imgs/pages/placeholder.jpg') }}" class="w-100 h-100" style="object-fit: cover; border-radius: 24px;">
                </div>
            </div>
        </div>
    </div>

@endsection
