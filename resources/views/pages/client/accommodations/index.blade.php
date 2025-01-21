@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="hs-d-flex hs-flex-grow-1">
        <div class="hs-container hs-mt-8">
            <h1 class="hs-text-center">Acomodações</h1>
            <div class="hs-row">
                @foreach ($accommodations as $accommodation)
                    <div class="hs-col-md-4">
                        <a href="" class="hs-card">
                            <div class="hs-card-body">
                                <div class="hs-d-flex hs-justify-content-center hs-mb-3">
                                    <img src="{{'/storage/' .  $accommodation->accommodation_types->img }}" alt="" width="85%">
                                </div>
                                <h5 class="hs-card-title">{{ $accommodation->accommodation_types->name}}</h5>
                                <p class="hs-card-text">Descrição: {{ $accommodation->description }}</p>
                                    <a href="{{route('client-create-reservations')}}" class="hs-btn hs-btn-primary">Reservar</a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection



