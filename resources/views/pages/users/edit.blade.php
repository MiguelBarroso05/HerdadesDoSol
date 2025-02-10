@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-col-md-8 hs-card">
                    <!-- User Profile Card -->
                    <div class=" hs-card-body hs-p-3">
                        <div class="hs-row hs-gx-4">
                            <!-- User Image Section -->
                            <div class="hs-col-auto">
                                <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                    <!-- Display user image or a default image if not available -->
                                    <img
                                        src="{{ $user->img ? asset($user->img) : asset('/imgs/users/no-image.png') }}"
                                        alt="profile_image" id="userImagePreview"
                                        class="hs-w-100 hs-border-radius-lg hs-shadow-sm">
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

                    <!-- User Information Card -->
                    <div>
                        <form action="{{ route('users.update', $user->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="hs-card-header hs-py-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Edit User</p>
                                    <x-custom-button type="cancelIcon" route="{{ route('users.index') }}"/>
                                </div>
                            </div>

                            <div class="hs-card-body hs-py-5">
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
                                                    value="{{ old('firstname', $user->firstname) }}">
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
                                                    value="{{ old('lastname', $user->lastname) }}">
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
                                                       type="text" value="{{ old('phone', $user->phone) }}">
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
                                                <x-country-select :user="$user" :countries='$countries'
                                                                  :name="'nationality'"/>
                                                @error('nationality')
                                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="api_failed" value="{{ $apiFailed ? 1 : 0 }}">

                                        <!-- Nif -->
                                        <div class="hs-col-md-3">
                                            <div class="hs-form-group">
                                                <label for="nif" class="hs-form-control-label">Nif</label>
                                                <input class="hs-form-control @error('nif') hs-is-invalid @enderror"
                                                       name="nif"
                                                       type="text" value="{{ old('nif', $user->nif) }}">
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
                                                    value="{{ old('birthdate', $user->birthdate->format('Y-m-d')) }}">
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
                                                       name="email" value="{{ old('email', $user->email) }}">
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
                                                                         value="{{ old('standard_group', $user->standard_group) }}"/>
                                                    @error('standard_group')
                                                    <div class="hs-invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row hs-col-md-3">
                                                <div class="hs-form-group">
                                                    <label for="children" class="hs-form-control-label">Children</label>
                                                    <x-mini-number-input name="children"
                                                                         value="{{ old('children', $user->children) }}"/>
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
                                            <x-role-select :user="$user" :roles="$roles" />
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
                                                :user="$user"
                                                :paramter="$user->language"
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
                                                       value="{{ old('balance', $user->balance) }}">
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
                                                <x-allergies-dropdown-input :user="$user"/>
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
                                                    :user="$user"
                                                    :paramter="$user->fav_estate"
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
                                <div class="row mt-5">
                                    <x-custom-button type="update" route={{null}}/>
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
