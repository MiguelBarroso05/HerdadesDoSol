@php use App\Models\Estate;
 use App\Models\Allergy;
 @endphp
@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
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
            <div style="width: 78%;" class="hs-bg-card hs-rounded-3 hs-p-5 hs-d-flex hs-flex-column hs-justify-content-between">
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
                                            <input class="hs-form-control @error('phone') hs-is-invalid @enderror" type="text"
                                                   name="phone" value="{{ old('phone', $user->phone)}}">
                                            @error('phone')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="hs-d-flex hs-justify-content-between">
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="nationality" class="hs-form-control-label">Nationality</label>
                                            <select
                                                class="hs-form-control custom-dropdown @error('nationality') hs-is-invalid @enderror"
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

                                    <!-- Nif Input -->
                                    <div style="width: 195px;">
                                        <div class="hs-form-group">
                                            <label for="nif" class="hs-form-control-label">Nif</label>
                                            <input class="hs-form-control @error('nif') hs-is-invalid @enderror" type="text"
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
                                                   value="{{ old('birthdate', $user->birthdate) }}">
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
                                                <input
                                                    class="hs-form-control @error('standard_group') hs-is-invalid @enderror"
                                                    type="text"
                                                    name="standard_group"
                                                    value="{{ old('standard_group', $user->standard_group) }}">
                                                @error('standard_group')
                                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Children Input -->
                                        <div style="width: 90px;">
                                            <div class="hs-form-group">
                                                <label for="children" class="hs-form-control-label">Children</label>
                                                <input class="hs-form-control @error('children') hs-is-invalid @enderror"
                                                       type="text"
                                                       name="children" value="{{ old('children', $user->children) }}">
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
                        </div>
                        <div style="width: 390px; height: 395px;"
                             class="hs-d-flex hs-flex-column hs-justify-content-between hs-align-items-end">
                            <img
                                src="{{ auth()->user()->img ? asset('storage/' . auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                alt="" class="hs-img-fluid hs-rounded-3" style="width: 240px">

                            <!-- Profile Image Upload -->
                            <div style="width: 240px;">
                                <input type="file" class="hs-form-control" name="img" id="inputGroupFile02"
                                       accept="image/*">
                            </div>

                            <!-- Language Input -->
                            <div style="width: 240px;">
                                <label for="language" class="hs-form-control-label">Prefered Language</label>
                                <select
                                    class="hs-form-control custom-dropdown @error('language') hs-is-invalid @enderror"
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
                    </div>
                    <div class="hs-d-flex hs-justify-content-between" style="margin-top: 1rem;">
                        <div style="width: 468px;">
                            <div class="hs-form-group">
                                <label for="language" class="hs-form-control-label">Favourite Estates</label>
                                <x-multiple-input :objectToList="Estate::all()"/>
                                @error('language')
                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div style="width: 583px;">
                            <div class="hs-form-group">
                                <label for="allergies" class="hs-form-control-label">Allergies</label>
                                <x-multiple-input :objectToList="Allergy::all()"/>
                                @error('allergies')
                                <div class="hs-invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="hs-d-flex hs-justify-content-between">
                        <x-custom-button type="update" route="{{null}}"/>
                        <x-custom-button type="cancel" route="{{route('personal-info')}}"/>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
