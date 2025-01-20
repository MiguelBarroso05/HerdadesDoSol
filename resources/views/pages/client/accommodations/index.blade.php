@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="d-flex flex-grow-1">
        <div class="container mt-8">
            <h1 class="text-center">Acomodações</h1>
            <div class="row">
                @foreach ($accommodations as $accommodation)
                    <div class="col-md-4">
                        <a href="" class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                <img src="{{'/storage/' .  $accommodation->accommodation_types->img }}" alt="" width="85%">
                                </div>
                                <h5 class="card-title">{{ $accommodation->accommodation_types->name}}</h5>
                                <p class="card-text">Descrição: {{ $accommodation->description }}</p>
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Reservar</button>
                                </form>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

@endsection
