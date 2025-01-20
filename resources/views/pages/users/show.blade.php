@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])

    <!-- Profile Card Section -->
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <!-- User profile image -->
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->img ? asset('storage/'.$user->img) : asset('/imgs/users/no-image.png') }}"
                             alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <!-- User name and role -->
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{$user->user_roles->first()->name}}
                        </p>
                    </div>
                </div>
                <!-- Buttons aligned to the right and vertically centered -->
                <div class="col d-flex align-items-center justify-content-end">
                    <!-- Edit button -->
                    <x-custom-button type="edit" route="{{ route('users.edit', $user) }}"/>
                    <!-- Cancel button -->
                    <x-custom-button type="cancel" route="{{ route('users.index') }}"/>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- User Information Section -->
            <div class="col-md-8">
                <div class="card h-100 d-flex flex-column justify-content-center">
                    <div class="card-header pb-0">
                        <h6>User Information</h6>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="w-100">
                            <p class="text-uppercase text-sm">Basic Information</p>
                            <div class="row">
                                <!-- Email -->
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                </div>
                                <!-- First name -->
                                <div class="col-md-6">
                                    <p><strong>First name:</strong> {{ $user->firstname }}</p>
                                </div>
                                <!-- Last name -->
                                <div class="col-md-6">
                                    <p><strong>Last name:</strong> {{ $user->lastname }}</p>
                                </div>
                                <!-- Birth Date -->
                                <div class="col-md-6">
                                    <p><strong>Birth Date:</strong> {{ $user->birthdate }}</p>
                                </div>
                                <!-- Nif -->
                                <div class="col-md-6">
                                    <p><strong>Nif:</strong> {{ $user->nif ?? 'none' }}</p>
                                </div>
                                <!-- Phone -->
                                <div class="col-md-6">
                                    <p><strong>Phone:</strong> {{ $user->phone ?? 'none' }}</p>
                                </div>
                                <!-- Balance -->
                                <div class="col-md-6">
                                    <p><strong>Balance:</strong> {{ $user->balance }}</p>
                                </div>
                            </div>

                            <!-- Divider -->
                            <hr class="horizontal dark">

                            <p class="text-uppercase text-sm">Address Information</p>
                            <div class="row">
                                <!-- Country -->
                                <div class="col-md-6">
                                    <p><strong>Country:</strong> {{ $user->country ?? 'none' }}</p>
                                </div>
                                <!-- City -->
                                <div class="col-md-6">
                                    <p><strong>City:</strong> {{ $user->city ?? 'none' }}</p>
                                </div>
                                <!-- Address -->
                                <div class="col-md-6">
                                    <p><strong>Address:</strong> {{ $user->address ?? 'none' }}</p>
                                </div>
                                <!-- Postal code -->
                                <div class="col-md-6">
                                    <p><strong>Postal code:</strong> {{ $user->postal ?? 'none' }}</p>
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
