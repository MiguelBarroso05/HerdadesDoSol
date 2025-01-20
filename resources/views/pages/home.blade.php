@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="main-content mt-0 flex-grow">
        <!-- Hero -->
        <section class="hero bg-cover bg-center min-h-screen flex items-center justify-center text-center home-image">
            <div class="text-white">
                <h1 class="text-4xl font-bold pt-12">Welcome to Our Estate!</h1>
                <p class="text-lg mt-12">Discover unique accommodations, exciting activities, and much more.</p>
                <div class="mt-4">
                    <a href="#accommodations" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-lg mr-2">Explore Accommodations</a>
                    <a href="#activities" class="border border-white text-white px-6 py-3 rounded-lg text-lg">Discover Activities</a>
                </div>
            </div>
        </section>

        <!-- Activities -->
        <section id="activities" class="py-10 bg-white">
            <div class="container mx-auto">
                <h2 class="text-center text-2xl font-bold mb-6">Activities</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($activities as $activity)
                        <div class="shadow-md rounded-lg overflow-hidden">
                            <img src="{{ $activity->img ? asset('storage/'.$activity->img) : asset('/imgs/users/no-image.png') }}" class="w-full h-48 object-cover" alt="{{ $activity->name }}">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold">{{ $activity->name }}</h5>
                                <p class="text-gray-600 mt-2">{{ $activity->description }}</p>
                                <a href="{{ route('activities.show', $activity->id) }}" class="block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded">View More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Accommodation Types -->
        <section id="accommodation-types" class="py-10 bg-gray-100">
            <div class="container mx-auto">
                <h2 class="text-center text-2xl font-bold mb-6">Accommodation Types</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($accommodation_types as $type)
                        <div class="shadow-md rounded-lg overflow-hidden">
                            <img src="{{ $type->img ? asset('storage/'.$type->img) : asset('/imgs/users/no-image.png') }}" class="w-full h-48 object-cover" alt="{{ $type->name }}">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold">{{ $type->name }}</h5>
                                <p class="text-gray-600 mt-2">{{ $type->description }}</p>
                                <a href="{{ route('accommodation_types.show', $type->id) }}" class="block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded">View More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Accommodations -->
        <section id="accommodations" class="py-10 bg-white">
            <div class="container mx-auto">
                <h2 class="text-center text-2xl font-bold mb-6">Accommodations</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($accommodations as $accommodation)
                        <div class="shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold">Room nº {{ $accommodation->id }}</h5>
                                <p class="text-gray-600 mt-2">Get a room fitted to accommodate a family of {{ $accommodation->size }}</p>
                                <a href="{{ route('accommodations.show', $accommodation->id) }}" class="block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded">View More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
