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

        .bg-custom-light {
            background-color: #e3e3e3;
        }

        .text-card-pm {
            font-size: 0.9rem;
            color: #949494;
        }

        .text-black {
            color: black;
        }

        .border-custom-black {
            border: 1px solid #BFBFBF;
        }

        .dashed-box {
            border: 2px dashed #437546;
            background-color: #fff;
            width: 240px;
            height: 94px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .billing-dashed-box {
            border: 1px solid #437546;
            background-color: #fff;
            width: 205px;
            height: 61px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box-icon {
            color: #437546;
            font-size: 23px;
            -webkit-text-stroke: 2px;
        }

        .payment-button-icon {
            color: #437546;
            font-size: 23px;
            -webkit-text-stroke: 1px;
        }

        .ml-custom-20 {
            margin-left: 20px;
        }

        .mr-custom-15 {
            margin-right: 15px;
        }

        .mt-custom-80 {
            margin-top: 80px;
        }

        .icon-text-container {
            align-items: center;
            justify-content: center;
        }

        .payment-button-text {
            color: #70777c;
            font-size: 12px;
            margin-right: 10px;
            margin-left: 10px;
        }


    </style>
    <main class="col-md-11 w-85 align-self-center mt-8 p-2  flex-grow-1">
        <div class="d-flex justify-content-between">
            <x-client-side-bar/>
            <div style="width: 1280px; display: flex;" class="bg-card rounded-3 m-0">
                <div style="width: 320px;" class="bg-custom-light border h-100 rounded-3 m-0 p-0 ">
                    <div class="p-4 ml-5">
                        <div class="text-black fs-5 fw-bold pb-1">
                            Payment Method
                        </div>
                        <div class="text-card-pm">
                            Cards and Billing
                        </div>
                    </div>
                    <div class="border-custom-black w-100"></div>
                    <div class="dashed-box m-4 rounded-3">
                        <i class="bi bi-plus-circle box-icon"></i>
                    </div>
                </div>

                <div class="p-4">
                    <div class="p-4">
                        <p>BILLING INFORMATION</p>
                        <div class="text-black icon-text-container" id="billing-info">No client information provided for
                            biling
                            <x-plus-button onclick="toggleComponents()"/>
                        </div>
                        <div class="justify-content-between" style="width: 450px; display: none;" id="payment-methods">
                            <x-payment-method-button id="billing-defalt" text="Use your personal information"
                                                     icon="bi bi-arrow-right-circle payment-button-icon mr-custom-15"/>
                            <x-payment-method-button id="billing-new" text="Create new billing information"
                                                     icon="bi bi-plus-circle payment-button-icon mr-custom-15"/>
                        </div>
                        <div class="py-4">
                            <p>ADDRESS INFORMATION</p>
                            <div class="text-black icon-text-container" id="billing1-info">No address information
                                defined
                                <x-plus-button onclick="toggleComponents1()"/>
                            </div>
                            <div class="justify-content-between" style="width: 450px; display: none;"
                                 id="payment1-methods">
                                <x-payment-method-button id="address-defalt" text="Use one of your addresses"
                                                         icon="bi bi-arrow-right-circle payment-button-icon mr-custom-15"/>
                                <x-payment-method-button id="address-new" text="Create new address information"
                                                         icon="bi bi-plus-circle payment-button-icon mr-custom-15"/>
                            </div>
                        </div>

                        <div class="py-4 mt-custom-80">
                            <p>PAYMENT INFORMATION</p>
                            <div class="text-black icon-text-container">No payment method defined, consider inserting a
                                method to facilitate payment
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:ignore.self class="modal fade" id="AlterarDepois" tabindex="-1"
                 @if ($errors->any()) style="display: block;" @endif>
                <div class="modal-dialog modal-dialog-centered" style="max-width: 40%">
                    <form wire:submit.prevent="submit">
                        <div class="modal-content">
                            <div class="col-10 align-self-center">
                                <div class="modal-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="modal-title align-self-center" style="color: black !important;"
                                            id="exampleModalLabel">BILLING INFORMATION</h5>
                                        <a type="button" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x fs-3" style="color: black !important;"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <p>PERSONAL INFORMATION</p>
                                    </div>
                                    <div class="row">
                                        <!-- Name Input -->
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name" class="form-control-label">Name</label>
                                                <input
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    type="text" wire:model.defer="name"
                                                    placeholder="Name">
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>

                                        <!-- NIF Input -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nif" class="form-control-label">NIF</label>
                                                <input
                                                    class="form-control @error('nif') is-invalid @enderror"
                                                    type="text" wire:model.defer="nif"
                                                    placeholder="NIF">
                                                @error('nif')
                                                <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>

                                        <!-- Email Input -->
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">Email</label>
                                                <input
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    type="text" wire:model.defer="email"
                                                    placeholder="Email">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>

                                        <!-- Phone Number Input -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phone" class="form-control-label">Phone Number</label>
                                                <input
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    type="text" wire:model.defer="phone"
                                                    placeholder="+000 000 000 000">
                                                @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="col-md-4">
                                            <x-custom-button type="create" route="{{null}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script>
        function toggleComponents() {
            const billingInfo = document.getElementById('billing-info') || document.getElementById('billing1-info');
            const paymentMethods = document.getElementById('payment-methods') || document.getElementById('payment1-methods');
            const plusButton = event.target.parentElement;

            if (paymentMethods.style.display === "none") {
                paymentMethods.style.display = "flex";
                billingInfo.style.display = "none";
            } else {
                paymentMethods.style.display = "none";
                billingInfo.style.display = "block";
                plusButton.style.display = "block";
            }
        }

        function toggleComponents1() {
            const billingInfo = document.getElementById('billing1-info');
            const paymentMethods = document.getElementById('payment1-methods');
            const plusButton = event.target.parentElement;

            if (paymentMethods.style.display === "none") {
                paymentMethods.style.display = "flex";
                billingInfo.style.display = "none";
            } else {
                paymentMethods.style.display = "none";
                billingInfo.style.display = "block";
                plusButton.style.display = "block";
            }
        }
    </script>
@endpush
