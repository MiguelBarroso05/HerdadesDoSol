@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
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
                    Latest Reviews
                </div>
                <div class="flex justify-between">
                    <div class="hs-mt-4">
                        <x-card-reviews/>
                    </div>
                    <div class="hs-mt-4">
                        <x-card-reviews/>
                    </div>
                    <div class="hs-mt-4">
                        <x-card-reviews/>
                    </div>
                    <div class="hs-align-content-center">View All</div>
                </div>
                <div class="hs-text-black hs-fs-5 hs-pb-1 hs-mt-4">
                    Reviews your products
                </div>
                <div class="hs-mt-4">
                    You have not purchased any products or visited any of our estates, please consider trying one of our products or an experience at one of our estates.
                </div>
            </div>
        </div>
    </main>
@endsection
