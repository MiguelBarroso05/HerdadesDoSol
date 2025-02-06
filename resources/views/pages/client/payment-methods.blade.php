@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <style>


        .hs-main-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
        }

        .hs-wishlist-card img {
            width: 100%;
            border-radius: 8px;
        }

        .hs-bg-custom-light {
            background-color: #e3e3e3;
        }

        .hs-text-card-pm {
            font-size: 0.9rem;
            color: #949494;
        }

        .hs-text-black {
            color: black;
        }

        .hs-border-custom-black {
            border: 1px solid #BFBFBF;
        }

        .hs-dashed-box {
            border: 2px dashed #437546;
            background-color: #fff;
            width: 240px;
            height: 94px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hs-billing-dashed-box {
            border: 1px solid #437546;
            background-color: #fff;
            width: 205px;
            height: 61px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hs-box-icon {
            color: #437546;
            font-size: 23px;
            -webkit-text-stroke: 2px;
        }

        .hs-payment-button-icon {
            color: #437546;
            font-size: 23px;
            -webkit-text-stroke: 1px;
        }

        .hs-ml-custom-20 {
            margin-left: 20px;
        }

        .hs-mr-custom-15 {
            margin-right: 15px;
        }

        .hs-mt-custom-80 {
            margin-top: 80px;
        }

        .hs-icon-text-container {
            align-items: center;
            justify-content: center;
        }

        .hs-payment-button-text {
            color: #70777c;
            font-size: 12px;
            margin-right: 10px;
            margin-left: 10px;
        }
    </style>
    <livewire:payment-method-page/>
@endsection

