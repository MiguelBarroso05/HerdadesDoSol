@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <livewire:CheckoutComponent :isReservation="$isReservation" />
@endsection


