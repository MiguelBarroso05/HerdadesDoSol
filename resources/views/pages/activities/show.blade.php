@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="col-admin">
        <!-- Profile Card Section -->
        <div class="hs-card hs-shadow-lg hs-mx-4 hs-card-profile-bottom">
            <div class="hs-card-body hs-p-3">
                <div class="hs-row hs-gx-4">
                    <!-- Activity profile image -->
                    <div class="hs-col-auto">
                        <div class="hs-avatar hs-avatar-xl hs-position-relative">
                            <img src="{{ $activity->img ? asset('/storage/'.$activity->img) : asset('/imgs/users/no-image.png') }}" alt="activity_image" class="hs-w-100 hs-border-radius-lg hs-shadow-sm">
                        </div>
                    </div>
                    <!-- Activity name -->
                    <div class="hs-col-auto hs-my-auto">
                        <div class="hs-h-100">
                            <h5 class="hs-mb-1">
                                {{ $activity->name }}
                            </h5>
                        </div>
                    </div>
                    <!-- Buttons aligned to the right and vertically centered -->
                    <div class="hs-col hs-d-flex hs-align-items-center hs-justify-content-end">
                        <!-- Edit button -->
                        <x-custom-button type="edit" route="{{ route('activities.edit', $activity) }}"/>
                        <!-- Cancel button -->
                        <x-custom-button type="cancel" route="{{ route('activities.index') }}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <!-- Information Card -->
                <div class="hs-col-md-8">
                    <div class="hs-card hs-h-100 hs-d-flex hs-flex-column hs-justify-content-center">
                        <div class="hs-card-header hs-pb-0">
                            <h6>Activity Information</h6>
                        </div>
                        <div class="hs-card-body hs-d-flex hs-align-items-center">
                            <div class="hs-w-100">
                                <p class="hs-text-uppercase hs-text-sm">Basic Information</p>
                                <div class="hs-row">
                                    <!-- Activity Name -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Activity Name:</strong> {{ $activity->name }}</p>
                                    </div>
                                    <!-- Description -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Description:</strong> {{ $activity->description }}</p>
                                    </div>
                                    <!-- Type -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Type:</strong> {{ $activity->activity_types->name ?? 'none' }}</p>
                                    </div>
                                    <!-- Created At -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Created At:</strong> {{ $activity->created_at ? $activity->created_at->format('d/m/Y') : 'none' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Image Section -->
                <div class="hs-col-md-4">
                    <div class="hs-card hs-h-100">
                        <img src="{{ asset('imgs/pages/placeholder.jpg') }}" class="hs-w-100 hs-h-100" style="object-fit: cover; border-radius: 24px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
