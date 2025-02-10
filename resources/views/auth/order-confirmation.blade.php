@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="hs-d-flex hs-flex-grow-1 hs-mt-8 hs-px-9 hs-justify-content-center hs-mb-2">
        <x-custom-alert type="warning" :session="session('warning')" />
        <x-custom-alert type="success" :session="session('success')" />
        <x-custom-alert type="error" :session="session('error')" />
        <div
            class="hs-d-flex hs-flex-column hs-justify-content-center hs-align-items-center hs-bg-card hs-rounded-3 hs-w-80 hs-h-80">
            <h3 class="hs-text-center hs-mt-5">Please check your email to verify your account.</h3>
            <p class="hs-text-center">If you didn't receive the email, click the button below to request another.</p>
            <a class="hs-btn hs-btn-primary hs-mt-5 hs-w-80" href="{{ route('orders.index') }}">Go to Orders</a>
        </div>
    </main>
@endsection
