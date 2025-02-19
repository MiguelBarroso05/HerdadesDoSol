<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset( '../imgs/logo/logo.png')}}">
    <title>Herdades do Sol</title>

    <!-- CSS Files -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{asset('assets/css/custom.css')}} " rel="stylesheet"/>
    <link href="{{asset('assets/css/hs-bootstrap.css')}} " rel="stylesheet"/>

    <livewire:styles/>
    <wireui:scripts />

</head>

<body class="{{ $class ?? '' }} hs-d-flex hs-flex-column hs-min-vh-100">

    @guest
        @yield('content')
        @include('layouts.footers.footer')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['login', 'register', 'recover-password']))
            @yield('content')
            @include('layouts.footers.footer')
        @elseif(auth()->check() && auth()->user()->hasrole('client'))
            @yield('content')

            @include('layouts.footers.footer')
        @else
            @if (in_array(request()->route()->getName(), ['home', 'products.index', 'products.show', 'checkout', 'reservation.create']))
                <div></div>
            @else
                <div class="hs-position-absolute hs-w-100 hs-min-height-200 hs-top-0 app-image">
                    <span class="hs-mask hs-opacity-6"></span>
                </div>
                <style>
                    body{
                        background-image: none;
                        background-color: #00000017;
                    }
                </style>
            @endif
            @include('layouts.navbars.auth.sidenav')
            <main class="hs-main-content hs-border-radius-lg hs-mt-0 hs-flex-grow-1">
                @yield('content')
            </main>

        @endif
    @endauth

    <livewire:scripts/>
    <script src="https://sandbox.paypal.com/sdk/js?client-id=AYK9nDavtGJIdiPRWSb6xHFJUKSOxB6vsIWOhsckO3op_zPO0tWBWNVUcTD-HabVcOH9jXKEyrf4yUTH&currency=EUR&disable-funding=credit,card"></script>
    <script src="{{asset('assets\js\preline.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')

</body>

</html>
