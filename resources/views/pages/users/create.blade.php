@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create User'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <!-- Create Form -->
    <div class="hs-container-fluid hs-py-4 hs-mt-8">
        <div class="hs-row hs-justify-content-center">
            <div class="hs-col-md-8 hs-card">

                <!-- User Information Card -->
                <div>
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="hs-card-header hs-py-3">
                            <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                <p class="hs-mb-0">Create User</p>
                                <x-custom-button type="cancelIcon" route="{{ route('users.index') }}"/>
                            </div>
                        </div>

                        <div class=" hs-card-body hs-p-4">
                            <div class="hs-row hs-gx-4">
                                <!-- User Image Section -->
                                <div class="hs-col-auto">
                                    <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                        <!-- Display default image if not available -->
                                        <img
                                            src="{{ asset('/imgs/users/no-image.png') }}"
                                            alt="profile_image" id="userImagePreview"
                                            class="hs-w-100 hs-border-radius-lg hs-shadow-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hs-card-body hs-py-3">
                            <!-- User Information Section -->
                            <p class="hs-text-uppercase hs-text-sm">User Information</p>
                            <div class="hs-row">
                                <div class="row">
                                    <!-- Profile Image Upload -->
                                    <div class="hs-col-md-3">
                                        <label for="username" class="hs-form-control-label">Image</label>
                                        <!-- Image Upload -->
                                        <input type="file" class="hs-form-control" name="img" id="userImageInput"
                                               accept="image/*">
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <!-- First Name Input -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="firstname" class="hs-form-control-label">First name</label>
                                            <input
                                                class="hs-form-control @error('firstname') hs-is-invalid @enderror"
                                                name="firstname" type="text"
                                                value="{{ old('firstname') }}">
                                            @error('firstname')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Last Name Input -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="lastname" class="hs-form-control-label">Last name</label>
                                            <input
                                                class="hs-form-control @error('lastname') hs-is-invalid @enderror"
                                                name="lastname" type="text"
                                                value="{{ old('lastname') }}">
                                            @error('lastname')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="phone" class="hs-form-control-label">Phone</label>
                                            <input class="hs-form-control @error('phone') hs-is-invalid @enderror"
                                                   name="phone"
                                                   type="text" value="{{ old('phone') }}">
                                            @error('phone')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="nationality"
                                                   class="hs-form-control-label">Nationality</label>
                                            <x-country-select :user="null" :countries='$countries'
                                                              :name="'nationality'"/>
                                            @error('nationality')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nif -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="nif" class="hs-form-control-label">Nif</label>
                                            <input class="hs-form-control @error('nif') hs-is-invalid @enderror"
                                                   name="nif"
                                                   type="text" value="{{ old('nif') }}">
                                            @error('nif')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Birth Date -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="birthdate" class="hs-form-control-label">Birth Date</label>
                                            <input
                                                class="hs-form-control @error('birthdate') hs-is-invalid @enderror"
                                                name="birthdate" type="date"
                                                value="{{ old('birthdate') }}">
                                            @error('birthdate')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <!-- Email Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="email" class="hs-form-control-label">Email address</label>
                                            <input class="hs-form-control @error('email') hs-is-invalid @enderror"
                                                   type="email"
                                                   name="email" value="{{ old('email') }}">
                                            @error('email')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row hs-col-md-6 flex justify-evenly">
                                        <div class="hs-col-md-3">
                                            <div class="hs-form-group">
                                                <label for="standard_group" class="hs-form-control-label">Group
                                                    Size</label>
                                                <x-mini-number-input name="standard_group"
                                                                     value="{{ old('standard_group') }}"/>
                                                @error('standard_group')
                                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row hs-col-md-3">
                                            <div class="hs-form-group">
                                                <label for="children" class="hs-form-control-label">Children</label>
                                                <x-mini-number-input name="children"
                                                                     value="{{ old('children') }}"/>
                                                @error('children')
                                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <!-- Role Input -->
                                    <div class="hs-col-md-3">
                                        <label for="role" class="hs-form-control-label">User Role</label>
                                        <x-role-select :user="null" :roles="$roles" />
                                    </div>

                                    <div class="hs-col-md-3">
                                        <label for="language" class="hs-form-control-label">Prefered
                                            Language</label>
                                        <x-dropdown-input
                                            :optionText="'name'"
                                            :multiple="false"
                                            :placeholder="'Select user prefered language...'"
                                            :fixed="'top'"
                                            :name="'language'"
                                            :object="$languages"
                                            :user="null"
                                            :paramter="null"
                                            :optionText="'name'"
                                        />
                                        @error('language')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Balance -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="balance" class="hs-form-control-label">Balance</label>
                                            <input class="hs-form-control @error('balance') hs-is-invalid @enderror"
                                                   name="balance" type="text"
                                                   value="{{ old('balance') }}">
                                            @error('balance')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <!-- Allergies -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="allergies" class="hs-form-control-label">Allergies</label>
                                            <x-allergies-dropdown-input :user="null"/>
                                            @error('allergies')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Fav Estate -->
                                    <div class="hs-col-md-3">
                                        <div class="hs-form-group">
                                            <label for="fav_estate" class="hs-form-control-label">Favourite Estate</label>
                                            <x-dropdown-input
                                                :optionText="'name'"
                                                :multiple="false"
                                                :placeholder="'Add your fav estate...'"
                                                :fixed="'top'"
                                                :name="'fav_estate'"
                                                :object="\App\Models\Estate::all()"
                                                :user="null"
                                                :paramter="null"
                                                :optionText="'name'"
                                            />
                                            @error('fav_estate')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Empty div -->
                                    <div class="hs-col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5 hs-col-md-6">
                                <x-custom-button type="create" route={{null}}/>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.getElementById('userImageInput').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('userImagePreview').src = e.target.result;
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
