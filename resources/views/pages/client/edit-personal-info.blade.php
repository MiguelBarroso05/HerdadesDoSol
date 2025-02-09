@php use App\Models\Estate;
@endphp
@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <style>
        body {
            background: linear-gradient(rgba(228, 229, 218, 0.8), rgba(228, 229, 218, 0.8)),
            url('../../imgs/pages/home_banner.png');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        .hs-card img {
            width: 50px;
        }

        .hs-main-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
        }

        .wishlist-card img {
            width: 100%;
            border-radius: 8px;
        }
    </style>
    <main class="hs-col-md-11 hs-w-85 hs-align-self-center hs-mt-8 hs-p-2 hs-flex-grow-1">
        <div class="hs-d-flex hs-justify-content-between">
            <x-client-side-bar/>
            <div style="width: 78%;"
                 class="hs-bg-card hs-rounded-3 hs-p-5 hs-d-flex hs-flex-column hs-justify-content-between">
                <form action="{{ route('personal-info.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p class="text-secondary">PERSONAL INFORMATION</p>
                    <div class="hs-d-flex hs-justify-content-between">
                        <div class="hs-d-flex hs-flex-column hs-justify-content-between"
                             style="width: 770px; height: 395px;">
                            <div>
                                <div class="hs-d-flex hs-justify-content-between">
                                    <!-- First Name Input -->
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="firstname" class="hs-form-control-label">First Name</label>
                                            <input class="hs-form-control @error('firstname') hs-is-invalid @enderror"
                                                   type="text"
                                                   name="firstname" value="{{ old('firstname', $user->firstname) }}">
                                            @error('firstname')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Last Name Input -->
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="lastname" class="hs-form-control-label">Last Name</label>
                                            <input class="hs-form-control @error('lastname') hs-is-invalid @enderror"
                                                   type="text"
                                                   name="lastname" value="{{ old('lastname', $user->lastname) }}">
                                            @error('lastname')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone Input -->
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="phone" class="hs-form-control-label">Phone Number</label>
                                            <input class="hs-form-control @error('phone') hs-is-invalid @enderror"
                                                   type="text"
                                                   name="phone" value="{{ old('phone', $user->phone)}}">
                                            @error('phone')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="hs-d-flex hs-justify-content-between">
                                    <!-- Nationality Input -->
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="nationality" class="hs-form-control-label">Nationality</label>
                                            <x-country-select :user="auth()->user()" :countries='$countries'
                                                              :name="'nationality'"/>
                                            @error('nationality')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="api_failed" value="{{ $apiFailed ? 1 : 0 }}">

                                    <!-- Nif Input -->
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="nif" class="hs-form-control-label">Nif</label>
                                            <input class="hs-form-control @error('nif') hs-is-invalid @enderror"
                                                   type="text"
                                                   name="nif" value="{{ old('nif', $user->nif)}}">
                                            @error('nif')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Birth Date Input -->
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="birthdate" class="hs-form-control-label">Birth Date</label>
                                            <input class="hs-form-control @error('birthdate') hs-is-invalid @enderror"
                                                   name="birthdate" type="date"
                                                   value="{{ old('birthdate', $user->birthdate->format('Y-m-d')) }}">
                                            @error('birthdate')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="hs-d-flex hs-justify-content-between">
                                    <!-- Email Input -->
                                    <div style="width: 483px;">
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

                                    <div style="width: 195px;" class="hs-d-flex hs-justify-content-between">
                                        <!-- Group Size Input -->
                                        <div style="width: 90px;">
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

                                        <!-- Children Input -->
                                        <div style="width: 90px;">
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
                            </div>
                            <div>
                                <p class="text-secondary">USER INFORMATION</p>
                                <!-- Preferences Input -->
                                <div>
                                    <label for="language" class="hs-form-control-label">Preferences</label>
                                    <select
                                        class="hs-form-control custom-dropdown @error('language') hs-is-invalid @enderror"
                                        name="language" id="language-input">

                                    </select>
                                    @error('language')
                                    <div class="hs-invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="width: 390px; height: 395px;"
                             class="hs-d-flex hs-flex-column hs-justify-content-between hs-align-items-end">
                            <img id="profileImage"
                                 src="{{ auth()->user()->img ? asset(auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                 class="hs-img-fluid hs-rounded-3" style="width: 240px">

                            <!-- Profile Image Upload -->
                            <div style="width: 240px;">
                                <input type="file" class="hs-form-control" name="img" id="profileImageInput"
                                       accept="image/*">
                            </div>
                            <!-- Language Input -->
                            <div style="width: 240px;">
                                <label for="language" class="hs-form-control-label">Prefered Language</label>
                                <x-dropdown-input
                                    :optionText="'name'"
                                    :multiple="false"
                                    :placeholder="'Select your prefered language...'"
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
                        </div>
                    </div>
                    <div class="hs-d-flex hs-justify-content-between" style="margin-top: 1rem;">
                        <div style="width: 468px;">
                            <div class="hs-form-group">
                                <label for="fav_estate" class="hs-form-control-label">Favourite Estate</label>
                                <x-dropdown-input
                                    :optionText="'name'"
                                    :multiple="false"
                                    :placeholder="'Add your fav estate...'"
                                    :fixed="'top'"
                                    :name="'fav_estate'"
                                    :object="Estate::all()"
                                    :user="$user"
                                    :paramter="$user->fav_estate"
                                    :optionText="'name'"
                                />
                                @error('fav_estate')
                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div style="width: 583px;">
                            <div class="hs-form-group">
                                <label for="allergies" class="hs-form-control-label">Allergies</label>
                                <x-allergies-dropdown-input :user="$user"/>
                                @error('allergies')
                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="hs-d-flex hs-justify-content-between">
                        <div class="hs-col-4">
                            <x-custom-button type="cancel" route="{{route('personal-info')}}"/>
                        </div>
                        <div>
                            <x-custom-button type="update" route="{{null}}"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script>
        document.getElementById('profileImageInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
