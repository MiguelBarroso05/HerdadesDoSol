@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <!-- Include the top navigation bar with the title "Profile" -->
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Estate'])


    <!-- Edit Form -->
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Error Messages -->
                <x-general-errors/>

                <!-- User Information Card -->
                <div class="card">
                    <form action="{{ route('users.store',) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Create User</p>
                                <!-- Action Buttons -->
                                <div>
                                    <!-- Create button -->
                                    <x-custom-button type="create" route={{null}}/>
                                    <!-- Cancel button-->
                                    <x-custom-button type="cancel" route="{{ route('users.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Mandatory Information Section -->
                            <p class="text-uppercase text-sm">Mandatory Information</p>
                            <div class="row">
                                <!-- Email Input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email address</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                               name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror"
                                               name="password" type="password"
                                               required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Confirm Password Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password" class="form-control-label">Confirm Password</label>
                                        <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                               name="password_confirmation" type="password"
                                               required>
                                        @error('password_confirmation')
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
                                               value="{{ old('firstname') }}" required>
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
                                               value="{{ old('lastname') }}" required>
                                        @error('lastname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Birth Date -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthdate" class="form-control-label">Birth Date</label>
                                        <input class="form-control @error('birthdate') is-invalid @enderror"
                                               name="birthdate" type="date"
                                               value="{{ old('birthdate') }}" required>
                                        @error('birthdate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Non Mandatory Information Section -->
                                <hr>
                                <p class="text-uppercase text-sm">Optional Information</p>


                                <!-- Profile Image Upload -->
                                <div class="col-md-6">
                                    <label for="username" class="form-control-label">Image</label>
                                    <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                           accept="image/*">
                                </div>

                                <!-- Nif -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nif" class="form-control-label">Nif</label>
                                        <input class="form-control @error('nif') is-invalid @enderror" name="nif"
                                               type="text" value="{{ old('nif') }}">
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
                                               type="text" value="{{ old('phone') }}">
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
                                               name="balance" type="text" value="{{ old('balance') }}">
                                        @error('balance')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
