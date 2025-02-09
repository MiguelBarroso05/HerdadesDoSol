@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <livewire:CheckoutComponent :isReservation="$isReservation" />
@endsection


