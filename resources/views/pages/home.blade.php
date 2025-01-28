@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')

    <main class="hs-main-content mt-0 hs-flex-grow-1">
        <!-- Hero -->
        <section class="hs-bg-cover hs-bg-center hs-align-items-center hs-justify-center hs-text-center home-image hs-min-vh-100">
            <div>
                <h1 class="hs-display-4 hs-fw-bold hs-pt-12">Welcome to Our Estate!</h1>
                <p class="hs-lead hs-mt-12 text-white">Discover unique accommodations, exciting activities, and much more.</p>
                <div class="hs-mt-4">
                    <a href="#accommodations" class="hs-btn hs-btn-primary hs-btn-lg hs-me-2 text-white">Explore Accommodations</a>
                    <a href="#activities" class="hs-btn hs-btn-outline-light hs-btn-lg text-white">Discover Activities</a>
                </div>
            </div>
        </section>

        <!-- Activities -->
        <section id="activities" class="hs-py-5 hs-bg-white">
            <div class="hs-container">
                <h2 class="hs-text-center hs-fw-bold hs-mb-4">Activities</h2>
                <div class="hs-row">
                    @foreach($activities as $activity)
                        <div class="hs-col-md-4 hs-mb-3">
                            <div class="hs-card hs-shadow-sm">
                                <img src="{{ $activity->img ? asset('storage/'.$activity->img) : asset('/imgs/users/no-image.png') }}" class="hs-card-img-top" alt="{{ $activity->name }}">
                                <div class="hs-card-body">
                                    <h5 class="hs-card-title">{{ $activity->name }}</h5>
                                    <p class="hs-card-text">{{ $activity->description }}</p>
                                    <x-custom-button type="viewMore" route="{{route('activities.show', $activity->id)}}"/>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Accommodation Types -->
        <section id="accommodation-types" class="hs-py-5 hs-bg-light">
            <div class="hs-container">
                <h2 class="hs-text-center hs-fw-bold hs-mb-4">Accommodation Types</h2>
                <div class="hs-row">
                    @foreach($accommodation_types as $type)
                        <div class="hs-col-md-4 hs-mb-3">
                            <div class="hs-card hs-shadow-sm">
                                <img src="{{ $type->img ? asset('storage/'.$type->img) : asset('/imgs/users/no-image.png') }}" class="hs-card-img-top" alt="{{ $type->name }}">
                                <div class="hs-card-body">
                                    <h5 class="hs-card-title">{{ $type->name }}</h5>
                                    <p class="hs-card-text">{{ $type->description }}</p>
                                    <x-custom-button type="viewMore" route="{{route('accommodation_types.show', $type->id)}}"/>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Accommodations -->
        <section id="accommodations" class="hs-py-5 hs-bg-white">
            <div class="hs-container">
                <h2 class="hs-text-center hs-fw-bold hs-mb-4">Accommodations</h2>
                <div class="hs-row">
                    @foreach($accommodations as $accommodation)
                        <div class="hs-col-md-4 hs-mb-3">
                            <div class="hs-card hs-shadow-sm">
                                <div class="hs-card-body">
                                    <h5 class="hs-card-title">Room nº {{ $accommodation->id }}</h5>
                                    <p class="hs-card-text">Get a room fitted to accommodate a familly of {{ $accommodation->size }}</p>
                                    <x-custom-button type="viewMore" route="{{route('accommodations.show', $accommodation->id)}}"/>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
