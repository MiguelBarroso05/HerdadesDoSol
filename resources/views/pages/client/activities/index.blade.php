@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <main class="hs-d-flex hs-flex-grow-1 mb-3">
        <div class="hs-container hs-mt-8">
            <h1 class="hs-text-center hs-mb-3">Activities</h1>
            <div class="hs-row">
                @foreach ($activities as $activity)
                    <div class="hs-mb-5 hs-w-50">
                        <div class="hs-card hs-shadow-sm" style="height: 300px;">
                            <div
                                class="hs-card-body hs-d-flex  hs-flex-row ">
                                <div class="hs-d-flex hs-justify-content-center hs-mb-3 hs-col-5">
                                    <img
                                        src="{{ $activity->img ? asset('storage/' . $activity->img) : asset('/imgs/users/no-image.png') }}"
                                        alt="" width="90%" class="hs-rounded-3 hs-shadow-sm"
                                        style="max-height: 250px; overflow: hidden; object-fit: cover">
                                </div>
                                <div
                                    class="hs-ps-1 hs-d-flex hs-flex-column hs-flex-grow-1 hs-justify-content-between hs-align-items-center">
                                    <div class="hs-w-100">
                                        <h3 class="hs-card-title">{{ $activity->name }}</h3>
                                    </div>
                                    <div class="hs-w-100">
                                    <p>{{ $activity->description }}</p>
                                    </div>
                                    <div class="hs-w-100 hs-d-flex  mt-3  hs-flex-row  ">
                                        <a href="{{ route('reservation.create') }}"
                                           class="hs-w-45 hs-btn hs-btn-primary ">Reservar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
