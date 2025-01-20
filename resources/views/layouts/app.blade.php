<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset( '../imgs/logo/logo.png')}}">
    <title>Herdades do Sol</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>

    <!-- Nucleo Icons -->
    <link href="{{asset( './assets/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('./assets/css/nucleo-svg.css')}} " rel="stylesheet"/>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/002da5e179.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/css/nucleo-svg.css')}} " rel="stylesheet"/>

    <!-- CSS Files -->

    @vite('resources/sass/app.scss')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/custom.css')}} " rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <livewire:styles/>
    <wireui:scripts />
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="{{ $class ?? '' }} d-flex flex-column min-vh-100">

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
        @if (in_array(request()->route()->getName(), ['home']))
            <div></div>
        @elseif (!in_array(request()->route()->getName(), ['home']))
            <div class="position-absolute w-100 min-height-200 top-0 app-image">
                <span class="mask bg-primary opacity-6"></span>
            </div>
        @endif
        @include('layouts.navbars.auth.sidenav')
        <main class="main-content border-radius-lg mt-0 flex-grow-1">
            @yield('content')
        </main>
        @include('components.fixed-plugin')
    @endif
@endauth

<!--   Core JS Files   -->
<script src="{{asset("assets/js/core/popper.min.js")}}"></script>
<script src="{{asset("assets/js/core/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/js/plugins/perfect-scrollbar.min.js")}}"></script>
<script src="{{asset("assets/js/plugins/smooth-scrollbar.min.js")}}"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset("assets/js/argon-dashboard.js")}}"></script>
<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
@stack('js')

<livewire:scripts/>
</body>

</html>
