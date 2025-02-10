@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User'])
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <div class="col-admin">
        <!-- Profile Card Section -->
        <div class="hs-card hs-shadow-lg hs-mx-4 hs-card-profile-bottom">
            <div class="hs-card-body hs-p-3">
                <div class="hs-row hs-gx-4 flex justify-between">
                    <div class="hs-col-md-6 flex">
                        <!-- User profile image -->
                        <div class="hs-col-2">
                            <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                <img src="{{ $user->img ? asset($user->img) : asset('/imgs/users/no-image.png') }}"
                                     alt="profile_image" class="hs-w-100 hs-border-radius-lg hs-shadow-sm">
                            </div>
                        </div>
                        <!-- User name and role -->
                        <div class="hs-col-10 hs-my-auto">
                            <div class="hs-h-100">
                                <h5 class="hs-mb-1">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </h5>
                                <p class="hs-mb-0 hs-font-weight-bold hs-text-sm">
                                    {{$user->user_roles->first()->name}}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons aligned to the right and vertically centered -->
                    <div class="hs-col-3 hs-d-flex hs-align-items-center hs-justify-content-end">
                        <!-- Edit button -->
                        <x-custom-button type="edit" route="{{ route('users.edit', $user) }}"/>
                        <!-- Cancel button -->
                        <x-custom-button type="cancelIcon" route="{{ route('users.index') }}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <!-- User Information Section -->
                <div class="hs-col-md-8">
                    <div class="hs-card hs-h-100 hs-d-flex hs-flex-column hs-justify-content-center">
                        <div class="hs-card-header hs-pb-0">
                            <h6>User Information</h6>
                        </div>
                        <div class="hs-card-body hs-d-flex hs-align-items-center hs-justify-content-center">
                            <div class="hs-w-100">
                                <p class="hs-text-uppercase hs-text-sm">Basic Information</p>
                                <div class="row flex justify-between">
                                    <!-- First name -->
                                    <div class="hs-col-md-3">
                                        <p><strong>First name:</strong> {{ $user->firstname }}</p>
                                    </div>
                                    <!-- Last name -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Last name:</strong> {{ $user->lastname }}</p>
                                    </div>

                                    <!-- Phone -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Phone:</strong> {{ $user->phone ?? 'none' }}</p>
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <!-- Nationality -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Nationality:</strong> {{ $user->nationality }}</p>
                                    </div>

                                    <!-- Nif -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Nif:</strong> {{ $user->nif }}</p>
                                    </div>

                                    <!-- Birth Date -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Birth Date:</strong> {{ $user->birthdate->format('d-m-Y') }}</p>
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <!-- Email -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                    </div>

                                    <!-- Allergies -->
                                    <div class="hs-col-md-6">
                                        <p>
                                            <strong>Allergies:</strong> {{ $user->allergies->isNotEmpty() ? $user->allergies->pluck('name')->implode(', ') : 'none' }}
                                        </p>
                                    </div>

                                </div>

                                <div class="row flex justify-between">
                                    <!-- Prefered Language -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Prefered language:</strong> {{ $user->language()->name }}</p>
                                    </div>

                                    <!-- Group Size -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Group Size:</strong> {{ $user->standard_group }}</p>
                                    </div>

                                    <!-- Childreen -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Children:</strong> {{ $user->children }}</p>
                                    </div>
                                </div>

                                <div class="row flex justify-between">
                                    <!-- Favorite estate -->
                                    <div class="hs-col-md-3">
                                        <p><strong>Favorite Estate:</strong> {{ $user->fav_estate() ??  'none' }}</p>
                                    </div>

                                    @if($user->user_roles->first()->name != 'admin')
                                        <!-- Balance -->
                                        <div class="hs-col-md-3">
                                            <p><strong>Balance:</strong> {{ $user->balance }}</p>
                                        </div>
                                    @endif

                                    <div class="hs-col-md-3">
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="hs-horizontal hs-dark">
                                <livewire:show-addresses :user="$user"/>
                                @foreach($user->addresses as $address)
                                    <x-show-address-modal :address="$address" :user="$user"/>
                                    @push('js')
                                        <script>
                                            document.getElementById('clickableDiv{{$address->id}}').addEventListener('click', function () {
                                                let modal = new bootstrap.Modal(document.getElementById('addressModal{{$address->id}}'));
                                                modal.show();
                                            });
                                        </script>
                                    @endpush
                                @endforeach
                                <livewire:address-form :user="$user" :modalIdName="'clientAddAddressModal'"
                                                       :redirectUrl="url()->current()"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Image Section -->
                <div class="hs-col-md-4">
                    <div class="hs-card hs-h-100">
                        <img src="{{ asset('imgs/pages/placeholder.jpg') }}" class="hs-w-100 hs-h-100"
                             style="object-fit: cover; border-radius: 1rem;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
