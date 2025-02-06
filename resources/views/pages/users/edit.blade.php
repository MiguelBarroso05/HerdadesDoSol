@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])

    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-col-md-8">
                    <!-- User Profile Card -->
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-row hs-gx-4">
                            <!-- User Image Section -->
                            <div class="hs-col-auto">
                                <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                    <!-- Display user image or a default image if not available -->
                                    <img
                                        src="{{ $user->img ? asset($user->img) : asset('/imgs/users/no-image.png') }}"
                                        alt="profile_image" class="hs-w-100 hs-border-radius-lg hs-shadow-sm">
                                </div>
                            </div>
                            <!-- User Name Section -->
                            <div class="hs-col-auto hs-my-auto">
                                <div class="hs-h-100">
                                    <h5 class="hs-mb-1">
                                        {{ $user->firstname .' '. $user->lastname }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    <x-general-errors/>
                    <!-- Sucess Message -->
                    <x-success-message/>
                    <!-- User Information Card -->
                    <div class="hs-card">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Edit User</p>
                                    <!-- Action Buttons -->
                                    <div>
                                        <!-- Update button -->
                                        <x-custom-button type="update" route={{null}}/>
                                        <!-- Cancel button -->
                                        <x-custom-button type="cancelIcon" route="{{ route('users.index') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- User Information Section -->
                                <p class="hs-text-uppercase hs-text-sm">User Information</p>
                                <div class="hs-row">
                                    <!-- Profile Image Upload -->
                                    <div class="hs-col-md-6">
                                        <label for="username" class="hs-form-control-label">Image</label>
                                        <input type="file" class="hs-form-control" name="img" id="inputGroupFile02"
                                               accept="image/*">
                                    </div>

                                    <!-- Email Input -->
                                    <div class="hs-col-md-12">
                                        <div class="hs-form-group">
                                            <label for="email" class="hs-form-control-label">Email address</label>
                                            <input class="hs-form-control @error('email') hs-is-invalid @enderror" type="email"
                                                   name="email" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- First Name Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="firstname" class="hs-form-control-label">First name</label>
                                            <input class="hs-form-control @error('firstname') hs-is-invalid @enderror"
                                                   name="firstname" type="text"
                                                   value="{{ old('firstname', $user->firstname) }}">
                                            @error('firstname')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Last Name Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="lastname" class="hs-form-control-label">Last name</label>
                                            <input class="hs-form-control @error('lastname') hs-is-invalid @enderror"
                                                   name="lastname" type="text"
                                                   value="{{ old('lastname', $user->lastname) }}">
                                            @error('lastname')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Role Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="role-input" class="hs-form-control-label">Role</label>
                                            <select class="hs-form-control hs-custom-dropdown @error('role') hs-is-invalid @enderror"
                                                    name="role" id="role-input">
                                                @foreach($roles as $role_id => $role_name)
                                                    <option
                                                        value="{{ $role_id }}"
                                                        {{$user->user_roles->first()->name == $role_name ? 'selected' : '' }}>
                                                        {{ $role_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Birth Date -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="birthdate" class="hs-form-control-label">Birth Date</label>
                                            <input class="hs-form-control @error('birthdate') hs-is-invalid @enderror"
                                                   name="birthdate" type="date"
                                                   value="{{ old('birthdate', $user->birthdate) }}">
                                            @error('birthdate')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nif -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="nif" class="hs-form-control-label">Nif</label>
                                            <input class="hs-form-control @error('nif') hs-is-invalid @enderror" name="nif"
                                                   type="text" value="{{ old('nif', $user->nif) }}">
                                            @error('nif')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="phone" class="hs-form-control-label">Phone</label>
                                            <input class="hs-form-control @error('phone') hs-is-invalid @enderror" name="phone"
                                                   type="text" value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Balance -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="balance" class="hs-form-control-label">Balance</label>
                                            <input class="hs-form-control @error('balance') hs-is-invalid @enderror"
                                                   name="balance" type="text" value="{{ old('balance', $user->balance) }}">
                                            @error('balance')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="balance" class="hs-form-control-label">Language</label>
                                            <select
                                                class="hs-form-control hs-custom-dropdown @error('language') hs-is-invalid @enderror"
                                                name="language" id="language-input">
                                                @foreach($languages as $language)
                                                    <option
                                                        value="{{ $language->id }}"
                                                        {{$user->language == $language->id ? 'selected' : '' }}>
                                                        {{ $language->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('language')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="balance" class="hs-form-control-label">Nationality</label>
                                            <select
                                                style="height: 40px !important; display: none"
                                                class="hs-form-control hs-custom-dropdown @error('nationality') hs-is-invalid @enderror"
                                                name="nationality" id="country-input">
                                                @foreach($countries as $country)
                                                    <option
                                                        data-icon="{{ $country['flag'] }}"
                                                        value="{{ $country['name'] }}"
                                                        {{ $user->nationality == $country['name'] ? 'selected' : '' }}>
                                                        {{ $country['name'] }}
                                                    </option>

                                                @endforeach
                                            </select>
                                            @error('nationality')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="hs-card-body"><!-- Contact Information Section -->
                            <hr class="hs-horizontal hs-dark">
                            <p class="hs-text-uppercase hs-text-sm">Address Information</p>
                            <livewire:address-form :user="$user" :modalIdName="'addAddressModal'"
                                                   :redirectUrl="url()->current()"/>

                            <div class="hs-row">
                                @foreach($user->addresses->reverse() as $address)
                                    <div class="hs-col-xl-4 hs-col-sm-6 hs-mb-xl-0 hs-mb-4">
                                        <div class="hs-card hs-min-vh-25">
                                            <div class="hs-card-body hs-p-3">
                                                <p class="hs-d-flex hs-justify-content-center hs-fw-bold">{{$address->pivot->addressIdentifier ?? 'No identifier'}}</p>
                                                <p class="hs-d-flex hs-justify-content-center">{{$address->city}}</p>
                                                <p class="hs-d-flex hs-justify-content-center">{{$address->street}}</p>
                                                <div class="hs-d-flex hs-justify-content-center">
                                                    <button type="button"
                                                            class="hs-btn hs-btn-secondary hs-btn-sm hs-mb-0 hs-bg-gradient-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#addressModal{{$address->id}}">
                                                        Show
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <x-address-modal :address="$address" :user="$user"/>
                                @endforeach
                                @if($user->addresses->count() < 3)
                                    <div class="hs-col-xl-4 hs-col-sm-6 hs-mb-xl-0 hs-mb-4">
                                        <div class="hs-card hs-min-vh-25 hs-border hs-border-primary">
                                            <div class="hs-card-body hs-p-3 hs-d-flex hs-align-items-center hs-justify-content-center">
                                                <button type="button" class="hs-btn hs-btn-primary hs-mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#addAddressModal">
                                                    <i class="bi bi-plus-circle hs-fs-5"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.getElementById('inputGroupFile02').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('profilePreview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>

        <script>
            // Script to auto-hide the message
            document.addEventListener('DOMContentLoaded', function () {
                const alert = document.getElementById('success-alert') || document.getElementById('warning-alert');

                if (alert) {
                    setTimeout(() => {
                        alert.classList.remove('show');
                        alert.classList.add('fade');
                        setTimeout(() => {
                            alert.remove();
                        }, 300); // Fade-out animation
                    }, 3000); // 3 seconds
                }
            });
        </script>
    @endpush
@endsection
