@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])

    <!-- Profile Card Section -->
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <!-- User profile image -->
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img
                            src="{{ auth()->user()->img ? asset('storage/'.auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                            class="w-100 border-radius-lg shadow-sm" alt="User image">
                    </div>
                </div>
                <!-- User name and role -->
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->firstname ?? 'Firstname' }} {{ auth()->user()->lastname ?? 'Lastname' }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ auth()->user()->user_roles->first()->name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <!-- Profile Edit Form -->
                <div class="card">
                    <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
                        @csrf <!-- CSRF token for security -->

                        <!-- Form Header -->
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- User Information Section -->
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <!-- Profile Image Upload -->
                                <div class="col-md-6">
                                    <label for="img" class="form-control-label">Image</label>
                                    <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                           accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <!-- Email input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" name="email"
                                               value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- First name input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First name</label>
                                        <input class="form-control" type="text" name="firstname"
                                               value="{{ old('firstname', auth()->user()->firstname) }}">
                                    </div>
                                </div>
                                <!-- Last name input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last name</label>
                                        <input class="form-control" type="text" name="lastname"
                                               value="{{ old('lastname', auth()->user()->lastname) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


    <!-- Side Image Section -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('imgs/pages/sign_in.jpg') }}" style="border-radius: 1rem;">
        </div>
    </div>
    </div>
    </div>
@endsection
