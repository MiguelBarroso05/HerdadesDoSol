@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <style>
        body {
            background: linear-gradient(rgba(228, 229, 218, 0.8), rgba(228, 229, 218, 0.8)),
            url('../../imgs/pages/home_banner.png');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        .bg-card {
            background-color: #f6f6f6;
            opacity: 0.82;
        }

        .card img {
            width: 50px;
        }

        .main-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
        }

        .wishlist-card img {
            width: 100%;
            border-radius: 8px;
        }

        .hs-text-black {
            color: black;
        }

        .hs-box-icon {
            color: #437546;
            font-size: 23px;
            -webkit-text-stroke: 2px;
        }

    </style>
    <main class="hs-col-md-11 hs-w-85 hs-align-self-center hs-mt-8 hs-p-2 hs-flex-grow-1">
        <div class="hs-d-flex hs-justify-content-between">
            <x-client-side-bar/>
            <div style="width: 78%;" class="bg-card hs-rounded-3 hs-p-5 hs-d-flex hs-flex-column">
                <div class="hs-text-black hs-fs-5 hs-pb-1">
                    ORDERS
                </div>
                <livewire:show-orders/>
            </div>
        </div>
    </main>
@endsection

