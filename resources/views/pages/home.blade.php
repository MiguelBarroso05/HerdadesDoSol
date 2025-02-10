@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <main class="hs-main-content mt-0 hs-flex-grow-1">
        <!-- Hero -->
        <section
            class="hs-bg-cover hs-bg-center hs-align-items-center hs-justify-center hs-text-center home-image hs-min-vh-100">
            <div>
                <h1 class="hs-display-4 hs-fw-bold hs-pt-12">Welcome to Our Estate!</h1>
                <p class="hs-lead hs-mt-12 text-white">Discover unique accommodations, exciting activities, and much more.
                </p>
                <div class="hs-mt-4">
                    <a href="#accommodations" class="hs-btn hs-btn-primary hs-btn-lg hs-me-2 text-white">Explore
                        Accommodations</a>
                    <a href="#activities" class="hs-btn hs-btn-outline-light hs-btn-lg text-white">Discover Activities</a>
                </div>
            </div>
        </section>

        <!-- Activities -->
        <section id="activities" class="hs-py-5 hs-bg-white">
            <div class="hs-container">
                <h2 class="hs-text-center hs-fw-bold hs-mb-4">Activities</h2>
                <div class="hs-row">
                    @foreach ($activities as $activity)
                        <div class="hs-col-md-4 hs-mb-3">
                            <div class="hs-card hs-shadow-sm">
                                <img src="{{ $activity->img ? asset('storage/' . $activity->img) : asset('/imgs/users/no-image.png') }}"
                                    class="hs-card-img-top" alt="{{ $activity->name }}">
                                <div class="hs-card-body">
                                    <h5 class="hs-card-title">{{ $activity->name }}</h5>
                                    <p class="hs-card-text">{{ $activity->description }}</p>
                                    <x-custom-button type="viewMore"
                                        route="{{ route('activities.show', $activity->id) }}" />
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
                    @foreach ($accommodation_types as $type)
                        <div class="hs-col-md-4 hs-mb-3">
                            <div class="hs-card hs-shadow-sm">
                                <img src="{{ $type->img ? asset('storage/' . $type->img) : asset('/imgs/users/no-image.png') }}"
                                    class="hs-card-img-top" alt="{{ $type->name }}">
                                <div class="hs-card-body">
                                    <h5 class="hs-card-title">{{ $type->name }}</h5>
                                    <p class="hs-card-text">{{ $type->description }}</p>
                                    <x-custom-button type="viewMore"
                                        route="{{ route('accommodation_types.show', $type->id) }}" />
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
                <h2 class="hs-text-center hs-fw-bold hs-mb-4">Best selling products</h2>
                <div class="grid grid-cols-3 gap-5">
                    @foreach ($top_products as $product)
                        <a class="hs-d-flex hs-flex-direction-column hs-align-items-center hs-justify-content-center" href="{{ route('products.show', $product->id) }}">
                            <div class="group transition-all duration-300 ease-in-out transform-gpu hover:-translate-y-1"
                                style="width: 300px;">
                                <div class="overflow-hidden hs-rounded-3 shadow-sm">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('/imgs/users/no-image.png') }}"
                                        alt="" width="300px"
                                        class="hs-rounded-3 object-cover transition-all duration-200 ease-in-out transform-gpu group-hover:scale-105"
                                        style="height: 200px">
                                </div>
                                <div class="hs-d-flex hs-justify-content-between mt-2 group-hover:text-primary">
                                    <span class="transition-colors duration-300"
                                        style="max-width: 150px">{{ $product->name }}</span>
                                    <span class="transition-colors duration-300">{{ $product->price }}€</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
