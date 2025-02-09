@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <main class="hs-d-flex hs-flex-grow-1 mb-3">
        <div class="hs-container hs-mt-8">
            <h1 class="hs-text-center">Accommodations</h1>
            <div class="hs-row">
                @foreach ($accommodations as $accommodation)
                    <div class="hs-col-md-4 mb-3">
                        <div class="hs-card" style="height: 450px">
                            <a href="" class="">
                                <div class="hs-card-body hs-d-flex hs-flex-column">
                                    <div class="hs-d-flex hs-justify-content-center hs-mb-3">
                                        <img src="{{ $accommodation->accommodation_types->img ? asset('storage/' . $accommodation->accommodation_types->img) : asset('/imgs/users/no-image.png') }}"
                                            alt="" width="85%"
                                            style="max-height: 205px; overflow: hidden; object-fit: cover">
                                    </div>
                                    <div class="hs-d-flex hs-flex-column hs-flex-grow-1 hs-justify-content-between">
                                        <h5 class="hs-card-title">{{ $accommodation->accommodation_types->name }}</h5>
                                        <p class="hs-card-text" style="max-height: 90px; overflow: ellipsis">
                                            {{ $accommodation->description }}</p>
                                        <div class="hs-w-100 hs-d-flex hs-justify-content-center mt-3">
                                            <a href="{{ route('reservation.create') }}"
                                                class="hs-btn hs-btn-primary hs-w-50">Reservar</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
