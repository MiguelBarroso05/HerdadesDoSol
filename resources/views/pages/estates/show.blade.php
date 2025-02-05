@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Estate'])
    <x-custom-alert type="success" :session="session('success')" />
    <div class="col-admin">
        <div class="hs-container-fluid">
            <div class="hs-row">
                <!-- Estate Information Section -->
                <div class="hs-col-md-8">
                    <div class="hs-card hs-h-100 hs-d-flex hs-flex-column hs-justify-content-center">
                        <div class="hs-card-header hs-pb-0 flex justify-between">
                            <h6>Estate Information</h6>
                            <div>
                                <x-custom-button type="edit" route="{{ route('estates.edit', $estate) }}"/>
                                <!-- Cancel button -->
                                <x-custom-button type="cancelIcon" route="{{ route('estates.index') }}"/>
                            </div>
                        </div>
                        <div class="hs-card-body hs-d-flex hs-align-items-center hs-justify-content-center">
                            <div class="hs-w-100">
                                <div class="hs-row">
                                    <!-- Name -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Name:</strong> {{ $estate->name }}</p>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="hs-horizontal hs-dark">

                                <p class="hs-text-uppercase hs-text-sm">Address Information</p>
                                <div class="hs-row">
                                    <!-- Country -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Country:</strong> {{ $estate->address->country ?? 'none' }}</p>
                                    </div>
                                    <!-- City -->
                                    <div class="hs-col-md-6">
                                        <p><strong>City:</strong> {{ $estate->address->city ?? 'none' }}</p>
                                    </div>
                                    <!-- Street -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Street:</strong> {{ $estate->address->street ?? 'none' }}</p>
                                    </div>
                                    <!-- Postal code -->
                                    <div class="hs-col-md-6">
                                        <p><strong>Zipcode:</strong> {{ $estate->address->zipcode ?? 'none' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Image Section -->
                <div class="hs-col-md-4">
                        <img src="{{ $estate->img ? asset('storage/'.$estate->img) : asset('/imgs/users/no-image.png') }}" class="w-auto h-[302px]"
                             style="object-fit: cover; border-radius: 24px;">
                </div>
            </div>
        </div>
    </div>
@endsection
