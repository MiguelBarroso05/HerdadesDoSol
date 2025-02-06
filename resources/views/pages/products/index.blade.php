@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <main class="hs-d-flex hs-flex-grow-1 hs-mt-8 hs-px-9 hs-justify-content-center hs-mb-2">
        <livewire:ProductList />
    </main>
@endsection
