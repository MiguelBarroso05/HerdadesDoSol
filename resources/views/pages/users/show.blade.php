@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User'])

    <div class="col-admin">
        <!-- Profile Card Section -->
        <div class="hs-card hs-shadow-lg hs-mx-4 hs-card-profile-bottom">
            <div class="hs-card-body hs-p-3">
                <div class="hs-row hs-gx-4 flex justify-between">
                    <div class="hs-col-md-6 flex">
                        <!-- User profile image -->
                        <div class="hs-col-2">
                            <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                <img src="{{ $user->img ? asset($user->img) : asset('/imgs/users/no-image.png') }}"
                                     alt="profile_image" class="hs-w-100 hs-border-radius-lg hs-shadow-sm">
                            </div>
                        </div>
                        <!-- User name and role -->
                        <div class="hs-col-10 hs-my-auto">
                            <div class="hs-h-100">
                                <h5 class="hs-mb-1">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </h5>
                                <p class="hs-mb-0 hs-font-weight-bold hs-text-sm">
                                    {{$user->user_roles->first()->name}}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons aligned to the right and vertically centered -->
                    <div class="hs-col-3 hs-d-flex hs-align-items-center hs-justify-content-end">
                        <!-- Edit button -->
                        <x-custom-button type="edit" route="{{ route('users.edit', $user) }}"/>
                        <!-- Cancel button -->
                        <x-custom-button type="cancelIcon" route="{{ route('users.index') }}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <!-- User Information Section -->
                <div class="hs-col-md-8">
                    <div class="hs-card hs-h-100 hs-d-flex hs-flex-column hs-justify-content-center">
                        <div class="hs-card-header hs-pb-0">
                            <h6>User Information</h6>
                        </div>
                        <div class="hs-card-body hs-d-flex hs-align-items-center hs-justify-content-center">
                            <div class="hs-w-100">
                                <p class="hs-text-uppercase hs-text-sm">Basic Information</p>
                                <div class="hs-row">
                                    <!-- Email -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                    </div>
                                    <!-- First name -->
                                    <div class="hs-col-md-6">
                                        <p><strong>First name:</strong> {{ $user->firstname }}</p>
                                    </div>
                                    <!-- Last name -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Last name:</strong> {{ $user->lastname }}</p>
                                    </div>
                                    <!-- Birth Date -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Birth Date:</strong> {{ $user->birthdate }}</p>
                                    </div>
                                    <!-- Nif -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Nif:</strong> {{ $user->nif ?? 'none' }}</p>
                                    </div>
                                    <!-- Phone -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Phone:</strong> {{ $user->phone ?? 'none' }}</p>
                                    </div>
                                    <!-- Balance -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Balance:</strong> {{ $user->balance }}</p>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="hs-horizontal hs-dark">

                                <p class="hs-text-uppercase hs-text-sm">Address Information</p>
                                <div class="hs-row">
                                    <!-- Country -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Country:</strong> {{ $user->country ?? 'none' }}</p>
                                    </div>
                                    <!-- City -->
                                    <div class="hs-col-md-6">
                                        <p><strong>City:</strong> {{ $user->city ?? 'none' }}</p>
                                    </div>
                                    <!-- Address -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Address:</strong> {{ $user->address ?? 'none' }}</p>
                                    </div>
                                    <!-- Postal code -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Postal code:</strong> {{ $user->postal ?? 'none' }}</p>
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
