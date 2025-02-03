@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create User'])

    <!-- Edit Form -->
    <div class="hs-container-fluid hs-py-4 hs-mt-8">
        <div class="hs-row hs-justify-content-center">
            <div class="hs-col-md-8">
                <!-- Error Messages -->
                <x-general-errors/>

                <!-- User Information Card -->
                <div class="hs-card">
                    <form action="{{ route('users.store',) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="hs-card-header hs-pb-0">
                            <div class="hs-row hs-d-flex hs-align-items-center hs-justify-content-between">
                                <p class="hs-mb-0 hs-col-md-6">Create User</p>
                                <!-- Action Buttons -->
                                <div class="hs-col-md-4 flex justify-around">
                                    <!-- Create button -->
                                    <x-custom-button type="create" route={{null}}/>
                                    <!-- Cancel button-->
                                    <x-custom-button type="cancel" route="{{ route('users.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="hs-card-body">
                            <!-- Mandatory Information Section -->
                            <p class="hs-text-uppercase hs-text-sm">Mandatory Information</p>
                            <div class="hs-row">
                                <!-- Email Input -->
                                <div class="hs-col-md-12">
                                    <div class="hs-form-group">
                                        <label for="email" class="hs-form-control-label">Email address</label>
                                        <input class="hs-form-control @error('email') hs-is-invalid @enderror" type="email"
                                               name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="hs-col-md-6">
                                    <div class="hs-form-group">
                                        <label for="password" class="hs-form-control-label">Password</label>
                                        <input class="hs-form-control @error('password') hs-is-invalid @enderror"
                                               name="password" type="password"
                                               required>
                                        @error('password')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Confirm Password Input -->
                                <div class="hs-col-md-6">
                                    <div class="hs-form-group">
                                        <label for="confirm_password" class="hs-form-control-label">Confirm Password</label>
                                        <input class="hs-form-control @error('password_confirmation') hs-is-invalid @enderror"
                                               name="password_confirmation" type="password"
                                               required>
                                        @error('password_confirmation')
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
                                               value="{{ old('firstname') }}" required>
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
                                               value="{{ old('lastname') }}" required>
                                        @error('lastname')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Birth Date -->
                                <div class="hs-col-md-6">
                                    <div class="hs-form-group">
                                        <label for="birthdate" class="hs-form-control-label">Birth Date</label>
                                        <input class="hs-form-control @error('birthdate') hs-is-invalid @enderror"
                                               name="birthdate" type="date"
                                               value="{{ old('birthdate') }}" required>
                                        @error('birthdate')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Non Mandatory Information Section -->
                                <hr>
                                <p class="hs-text-uppercase hs-text-sm">Optional Information</p>


                                <!-- Profile Image Upload -->
                                <div class="hs-col-md-6">
                                    <label for="username" class="hs-form-control-label">Image</label>
                                    <input type="file" class="hs-form-control" name="img" id="inputGroupFile02"
                                           accept="image/*">
                                </div>

                                <!-- Nif -->
                                <div class="hs-col-md-6">
                                    <div class="hs-form-group">
                                        <label for="nif" class="hs-form-control-label">Nif</label>
                                        <input class="hs-form-control @error('nif') hs-is-invalid @enderror" name="nif"
                                               type="text" value="{{ old('nif') }}">
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
                                               type="text" value="{{ old('phone') }}">
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
                                               name="balance" type="text" value="{{ old('balance') }}">
                                        @error('balance')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

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
    @endpush
@endsection
