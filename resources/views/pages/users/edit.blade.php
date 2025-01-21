@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <!-- Include the top navigation bar with the title "Profile" -->
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])


    <!-- Edit Form -->
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- User Profile Card -->
                <div class="card-body p-3">
                    <div class="row gx-4">
                        <!-- User Image Section -->
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <!-- Display user image or a default image if not available -->
                                <img
                                    src="{{ $user->img ? asset('storage/'.$user->img) : asset('/imgs/users/no-image.png') }}"
                                    alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <!-- User Name Section -->
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
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
                <div class="card">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Edit User</p>
                                <!-- Action Buttons -->
                                <div>
                                    <!-- Update button -->
                                    <x-custom-button type="update" route={{null}}/>
                                    <!-- Cancel button -->
                                    <x-custom-button type="cancel" route="{{ route('users.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- User Information Section -->
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <!-- Profile Image Upload -->
                                <div class="col-md-6">
                                    <label for="username" class="form-control-label">Image</label>
                                    <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                           accept="image/*">
                                </div>

                                <!-- Email Input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email address</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                               name="email" value="{{ old('email', $user->email) }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- First Name Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname" class="form-control-label">First name</label>
                                        <input class="form-control @error('firstname') is-invalid @enderror"
                                               name="firstname" type="text"
                                               value="{{ old('firstname', $user->firstname) }}">
                                        @error('firstname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Last Name Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname" class="form-control-label">Last name</label>
                                        <input class="form-control @error('lastname') is-invalid @enderror"
                                               name="lastname" type="text"
                                               value="{{ old('lastname', $user->lastname) }}">
                                        @error('lastname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Role Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role-input" class="form-control-label">Role</label>
                                        <select class="form-control custom-dropdown @error('role') is-invalid @enderror"
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthdate" class="form-control-label">Birth Date</label>
                                        <input class="form-control @error('birthdate') is-invalid @enderror"
                                               name="birthdate" type="date"
                                               value="{{ old('birthdate', $user->birthdate) }}">
                                        @error('birthdate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nif -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nif" class="form-control-label">Nif</label>
                                        <input class="form-control @error('nif') is-invalid @enderror" name="nif"
                                               type="text" value="{{ old('nif', $user->nif) }}">
                                        @error('nif')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">Phone</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                               type="text" value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Balance -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="balance" class="form-control-label">Balance</label>
                                        <input class="form-control @error('balance') is-invalid @enderror"
                                               name="balance" type="text" value="{{ old('balance', $user->balance) }}">
                                        @error('balance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="balance" class="form-control-label">Language</label>
                                        <select
                                            class="form-control custom-dropdown @error('language') is-invalid @enderror"
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
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="balance" class="form-control-label">Nationality</label>
                                        <select
                                            style="height: 40px !important; display: none"
                                            class="form-control custom-dropdown @error('nationality') is-invalid @enderror"
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
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body"><!-- Contact Information Section -->
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Address Information</p>
                        <livewire:address-form :user="$user" :modalIdName="'addAddressModal'"
                                               :redirectUrl="url()->current()"/>

                        <div class="row">
                            @foreach($user->addresses->reverse() as $address)
                                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                                    <div class="card min-vh-25">
                                        <div class="card-body p-3">
                                            <p class="d-flex justify-content-center fw-bold">{{$address->pivot->addressIdentifier ?? 'No identifier'}}</p>
                                            <p class="d-flex justify-content-center">{{$address->city}}</p>
                                            <p class="d-flex justify-content-center">{{$address->street}}</p>
                                            <div class="d-flex justify-content-center">
                                                <button type="button"
                                                        class="btn btn-secondary btn-sm mb-0 bg-gradient-info"
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
                                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                                    <div class="card min-vh-25 border border-primary">
                                        <div class="card-body p-3 d-flex align-items-center justify-content-center">
                                            <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal"
                                                    data-bs-target="#addAddressModal">
                                                <i class="fa-solid fa-circle-plus fs-5"></i>
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
            // sdofmsdf

            $('#country-input').select2({
                templateResult: function(data) {
                    if (!data.id) return data.text; // Placeholder ou sem dados
                    const iconPath = $(data.element).data('icon'); // Caminho do SVG
                    return $(
                        `<span>
                <img src="${iconPath}" alt="" style="width: 20px;  margin-right: 10px;">
                ${data.text}
            </span>`
                    );
                },
                templateSelection: function(data) {
                    if (!data.id) return data.text; // Placeholder ou sem dados
                    const iconPath = $(data.element).data('icon'); // Caminho do SVG
                    return $(
                        `<span>
                <img src="${iconPath}" alt="" style="width: 20px;  margin-right: 10px;">
                ${data.text}
            </span>`
                    );
                }
            });

        </script>

    @endpush
@endsection
