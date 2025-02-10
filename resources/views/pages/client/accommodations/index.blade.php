@extends('layouts.app', ['class' => 'hs-bg-red'])

@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <main class="hs-d-flex hs-flex-grow-1 mb-3">
        <div class="hs-container hs-mt-8">
            <h1 class="hs-text-center hs-mb-3">Accommodations</h1>
            <div class="hs-row">
                @foreach ($accommodations as $accommodation)
                    <div class="hs-mb-5">
                        <div class="hs-card hs-shadow-sm" style="height: 300px;">
                            <div
                                class="hs-card-body hs-d-flex @if ($loop->index % 2 != 0) hs-flex-row-reverse @else hs-flex-row @endif ">
                                <div class="hs-d-flex hs-justify-content-center hs-mb-3 hs-col-4">
                                    <img src="{{ $accommodation->img ? asset('storage/' . $accommodation->img) : asset('/imgs/users/no-image.png') }}"
                                        alt="" width="90%" class="hs-rounded-3 hs-shadow-sm"
                                        style="max-height: 250px; overflow: hidden; object-fit: cover">
                                </div>
                                <div
                                    class="hs-d-flex hs-flex-column hs-flex-grow-1 hs-justify-content-between hs-align-items-center">
                                    <div class="hs-w-100">
                                        <h3 class="hs-card-title">{{ $accommodation->name }}</h3>
                                    </div>
                                    <p class="hs-card-text">
                                        {{ $accommodation->description }}

                                    </p>

                                    <div class="hs-w-100 hs-d-flex  mt-3 @if ($loop->index % 2 != 0) hs-flex-row  @else hs-flex-row-reverse hs-px-2 @endif ">
                                        <a href="{{ route('reservation.create') }}"
                                            class="hs-w-25 hs-btn hs-btn-primary ">Reservar</a>
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
