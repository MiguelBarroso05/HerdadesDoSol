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

        .hs-bg-card {
            background-color: #f6f6f6;
            opacity: 0.82;
        }

        .hs-card img {
            width: 50px;
        }

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
    <main class="hs-col-md-11 hs-w-85 hs-align-self-center hs-mt-8 p-2 hs-flex-grow-1">
        <div class="hs-d-flex hs-justify-content-between">
            <x-client-side-bar/>
            <div style="width: 1280px; display: flex;" class="hs-bg-card hs-rounded-3 hs-m-0">
                <div style="width: 320px;" class="hs-bg-custom-light hs-border hs-h-100 hs-rounded-3 hs-m-0 hs-p-0 ">
                    <div class="hs-p-4 hs-ml-5">
                        <div class="hs-text-black hs-fs-5 hs-fw-bold hs-pb-1">
                            Payment Method
                        </div>
                        <div class="hs-text-card-pm">
                            Cards and Billing
                        </div>
                    </div>
                    <div class="hs-border-custom-black hs-w-100"></div>
                    <div class="hs-dashed-box hs-m-4 hs-rounded-3">
                        <i class="bi bi-plus-circle hs-box-icon"></i>
                    </div>
                </div>

                <div class="hs-p-4">
                    <div class="hs-p-4">
                        <p>BILLING INFORMATION</p>
                        <div class="hs-text-black hs-icon-text-container" id="billing-info">No client information provided for
                            biling
                            <x-plus-button onclick="toggleComponents()"/>
                        </div>
                        <div class="hs-justify-content-between" style="width: 450px; display: none;" id="payment-methods">
                            <x-payment-method-button id="billing-default" text="Use your personal information"
                                                     icon="bi bi-arrow-right-circle payment-button-icon mr-custom-15"/>
                            <x-payment-method-button id="billing-new" text="Create new billing information"
                                                     icon="bi bi-plus-circle payment-button-icon mr-custom-15"/>
                        </div>
                        <div class="hs-py-4">
                            <p>ADDRESS INFORMATION</p>
                            <div class="hs-text-black hs-icon-text-container" id="billing1-info">No address information
                                defined
                                <x-plus-button onclick="toggleComponents1()"/>
                            </div>
                            <div class="hs-justify-content-between" style="width: 450px; display: none;"
                                 id="payment1-methods">
                                <x-payment-method-button id="address-default" text="Use one of your addresses"
                                                         icon="bi bi-arrow-right-circle payment-button-icon mr-custom-15"/>
                                <x-payment-method-button id="address-new" text="Create new address information"
                                                         icon="bi bi-plus-circle payment-button-icon mr-custom-15"/>
                            </div>
                        </div>

                        <div class="hs-py-4 hs-mt-custom-80">
                            <p>PAYMENT INFORMATION</p>
                            <div class="hs-text-black hs-icon-text-container">No payment method defined, consider inserting a
                                method to facilitate payment
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:ignore.self class="hs-modal hs-fade" id="aa" tabindex="-1"
                 @if ($errors->any()) style="display: block;" @endif>
                <div class="hs-modal-dialog hs-modal-dialog-centered" style="max-width: 40%">
                    <form wire:submit.prevent="submit">
                        <div class="hs-modal-content">
                            <div class="hs-col-10 hs-align-self-center">
                                <div class="hs-modal-body">
                                    <div class="hs-d-flex hs-justify-content-between">
                                        <h5 class="hs-modal-title hs-align-self-center" style="color: black !important;"
                                            id="exampleModalLabel">BILLING INFORMATION</h5>
                                        <a type="button" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x fs-3" style="color: black !important;"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <p>PERSONAL INFORMATION</p>
                                    </div>
                                    <div class="hs-row">
                                        <!-- Name Input -->
                                        <div class="hs-col-md-8">
                                            <div class="hs-form-group">
                                                <label for="name" class="hs-form-control-label">Name</label>
                                                <input
                                                    class="hs-form-control @error('name') is-invalid @enderror"
                                                    type="text" wire:model.defer="name"
                                                    placeholder="Name">
                                                @error('name')
                                                <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>

                                        <!-- NIF Input -->
                                        <div class="hs-col-md-4">
                                            <div class="hs-form-group">
                                                <label for="nif" class="hs-form-control-label">NIF</label>
                                                <input
                                                    class="hs-form-control @error('nif') is-invalid @enderror"
                                                    type="text" wire:model.defer="nif"
                                                    placeholder="NIF">
                                                @error('nif')
                                                <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>

                                        <!-- Email Input -->
                                        <div class="hs-col-md-8">
                                            <div class="hs-form-group">
                                                <label for="email" class="hs-form-control-label">Email</label>
                                                <input
                                                    class="hs-form-control @error('email') is-invalid @enderror"
                                                    type="text" wire:model.defer="email"
                                                    placeholder="Email">
                                                @error('email')
                                                <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>

                                        <!-- Phone Number Input -->
                                        <div class="hs-col-md-4">
                                            <div class="hs-form-group">
                                                <label for="phone" class="hs-form-control-label">Phone Number</label>
                                                <input
                                                    class="hs-form-control @error('phone') is-invalid @enderror"
                                                    type="text" wire:model.defer="phone"
                                                    placeholder="+000 000 000 000">
                                                @error('phone')
                                                <div class="hs-invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hs-d-flex hs-justify-content-end">
                                            <x-custom-button type="create" route="{{null}}"/>
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
        document.getElementById('billing-new').addEventListener('click', function () {
            let modal = new bootstrap.Modal(document.getElementById(''));
            modal.show();
        });

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
