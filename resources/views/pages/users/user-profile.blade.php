@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])

    <div class="col-admin">
        <!-- Profile Card Section -->
        <div class="hs-card hs-shadow-lg hs-mx-4 hs-card-profile-bottom">
            <div class="hs-card-body hs-p-3">
                <div class="hs-row hs-gx-4">
                    <!-- User profile image -->
                    <div class="hs-col-auto">
                        <div class="hs-avatar hs-avatar-xl hs-position-relative">
                            <img
                                src="{{ auth()->user()->img ? asset('storage/'.auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                class="hs-w-100 hs-border-radius-lg hs-shadow-sm" alt="User image">
                        </div>
                    </div>
                    <!-- User name and role -->
                    <div class="hs-col-auto hs-my-auto">
                        <div class="hs-h-100">
                            <h5 class="hs-mb-1">
                                {{ auth()->user()->firstname ?? 'Firstname' }} {{ auth()->user()->lastname ?? 'Lastname' }}
                            </h5>
                            <p class="hs-mb-0 hs-font-weight-bold hs-text-sm">
                                {{ auth()->user()->user_roles->first()->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <div class="hs-col-md-8">
                    <!-- Profile Edit Form -->
                    <div class="hs-card">
                        <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
                            @csrf <!-- CSRF token for security -->

                            <!-- Form Header -->
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center">
                                    <p class="hs-mb-0">Edit Profile</p>
                                    <!-- Submit button -->
                                    <button type="submit" class="hs-btn hs-btn-primary hs-btn-sm hs-ms-auto">Save</button>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- User Information Section -->
                                <p class="hs-text-uppercase hs-text-sm">User Information</p>
                                <div class="hs-row">
                                    <!-- Profile Image Upload -->
                                    <div class="hs-col-md-6">
                                        <label for="img" class="hs-form-control-label">Image</label>
                                        <input type="file" class="hs-form-control" name="img" id="inputGroupFile02"
                                               accept="image/*">
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <!-- Email input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">Email address</label>
                                            <input class="hs-form-control" type="email" name="email"
                                                   value="{{ old('email', auth()->user()->email) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <!-- First name input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">First name</label>
                                            <input class="hs-form-control" type="text" name="firstname"
                                                   value="{{ old('firstname', auth()->user()->firstname) }}">
                                        </div>
                                    </div>
                                    <!-- Last name input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">Last name</label>
                                            <input class="hs-form-control" type="text" name="lastname"
                                                   value="{{ old('lastname', auth()->user()->lastname) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Side Image Section -->
                <div class="hs-col-md-4">
                    <div class="hs-card">
                        <img src="{{ asset('imgs/pages/sign_in.jpg') }}" style="border-radius: 1rem; height: 400px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
