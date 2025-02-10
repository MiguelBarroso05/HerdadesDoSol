@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="col-admin">
        <!-- Profile Card Section -->
        <div class="hs-card hs-shadow-lg hs-mx-4 hs-card-profile-bottom">
            <div class="hs-card-body hs-p-3">
                <div class="hs-row hs-gx-4">
                    <!-- User profile image -->
                    <div class="hs-col-auto">
                        <div class="hs-avatar hs-avatar-xl hs-position-relative">
                            <img
                                src="{{ auth()->user()->img ? asset(auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                id="adminImage"
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
                            <div class="hs-card-header hs-pb-0 rounded-2xl">
                                <div class="hs-d-flex hs-align-items-center justify-between">
                                    <p class="hs-mb-0">Edit Profile</p>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- User Information Section -->
                                <p class="hs-text-uppercase hs-text-sm">User Information</p>
                                <div class="hs-row">
                                    <!-- Profile Image Upload -->
                                    <div class="hs-col-md-6">
                                        <label for="img" class="hs-form-control-label">Image</label>
                                        <input type="file" class="hs-form-control @error('img') hs-is-invalid @enderror" name="img" id="adminImageInput"
                                               accept="image/*">
                                        @error('img')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">Email address</label>
                                            <input class="hs-form-control @error('email') hs-is-invalid @enderror" type="email" name="email"
                                                   value="{{ old('email', auth()->user()->email) }}">
                                            @error('email')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <!-- First name input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">First name</label>
                                            <input class="hs-form-control @error('firstname') hs-is-invalid @enderror" type="text" name="firstname"
                                                   value="{{ old('firstname', auth()->user()->firstname) }}">
                                            @error('firstname')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Submit button -->
                                        <x-custom-button type="update" route="{{null}}" />
                                    </div>
                                    <!-- Last name input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">Last name</label>
                                            <input class="hs-form-control @error('lastname') hs-is-invalid @enderror" type="text" name="lastname"
                                                   value="{{ old('lastname', auth()->user()->lastname) }}">
                                            @error('lastname')
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
                    <div class="hs-card">
                        <img src="{{ asset('imgs/pages/sign_in.jpg') }}" style="border-radius: 1rem; height: 389.56px; width: auto; object-fit: cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.getElementById('adminImageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('adminImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
