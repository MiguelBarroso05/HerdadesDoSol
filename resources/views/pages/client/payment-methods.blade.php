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
    <main class="hs-col-md-11 hs-w-85 hs-align-self-center hs-mt-8 hs-p-2 hs-flex-grow-1">
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

                <div class="hs-p-4 hs-w-md-100">
                    <div class="hs-p-4">
                        <div class="hs-d-flex hs-justify-content-between">
                            <p>BILLING INFORMATION</p>
                            @if($userBillingInfo)
                                <a id="openEditBillingInfoModal" class="mx-2"><i
                                        class="bi bi-pencil-square hs-fs-5" style="color: #2B6EFF; cursor: pointer"></i></a>
                            @endif
                        </div>
                        @if($userBillingInfo && $userBillingInfo->name != null)
                            <div id="personal-billing-info">
                                <div>
                                    <div class="hs-row">
                                        <div class="hs-col-md-6">
                                            <p><strong>Name: </strong> {{$userBillingInfo->name}}</p>
                                        </div>
                                        <div class="hs-col-md-4">
                                            <p><strong>NIF: </strong> {{$userBillingInfo->nif ?? 'none'}}</p>
                                        </div>
                                    </div>
                                    <div class="hs-row">
                                        <div class="hs-col-md-6">
                                            <p><strong>Email: </strong> {{$userBillingInfo->email}}</p>
                                        </div>
                                        <div class="hs-col-md-4">
                                            <p><strong>Phone: </strong> {{$userBillingInfo->phone ?? 'none'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else()
                            <div class="hs-text-black hs-icon-text-container" id="billing-info">No client information
                                provided for biling
                                <x-plus-button onclick="toggleComponents()"/>
                            </div>
                            <div class="hs-justify-content-between" style="width: 450px; display: none;"
                                 id="payment-methods">
                                <livewire:billing-personal-info id="defaultPersonalInfo"
                                                                text="Use your personal information"
                                                                icon="bi bi-arrow-right-circle hs-payment-button-icon hs-mr-custom-15"
                                                                :user="auth()->user()"/>
                                <x-payment-method-button modalToOpen="#newPersonalInfoForm"
                                                         text="Create new billing information"
                                                         icon="bi bi-plus-circle hs-payment-button-icon hs-mr-custom-15"/>
                            </div>
                        @endif
                        <div class="hs-py-4">
                            <p>ADDRESS INFORMATION</p>
                            @if($userBillingInfo && $userBillingInfo->address_id)
                                <div id="address-billing-info">
                                    <div class="hs-row">
                                        <div class="hs-col-md-4">
                                            <p><strong>Country: </strong> {{$userBillingInfo->address->country}}</p>
                                        </div>
                                        <div class="hs-col-md-6">
                                            <p><strong>City: </strong> {{$userBillingInfo->address->city}}</p>
                                        </div>
                                    </div>
                                    <div class="hs-row">
                                        <div class="hs-col-md-4">
                                            <p><strong>Zipcode: </strong> {{$userBillingInfo->address->zipcode}}</p>
                                        </div>
                                        <div class="hs-col-md-6">
                                            <p><strong>Street: </strong> {{$userBillingInfo->address->street}}</p>
                                        </div>
                                    </div>
                                </div>
                            @else()
                                <div class="hs-text-black hs-icon-text-container" id="billing1-info">No address
                                    information
                                    defined
                                    <x-plus-button onclick="toggleComponents1()"/>
                                </div>
                                <div class="hs-justify-content-between" style="width: 450px; display: none;"
                                     id="payment1-methods">

                                    <x-payment-method-button modalToOpen="#newAddressInfoForm"
                                                             text="Create new address information"
                                                             icon="bi bi-plus-circle hs-payment-button-icon hs-mr-custom-15"/>
                                </div>
                            @endif
                        </div>
                        <div class="hs-py-4 hs-mt-custom-80">
                            <p>PAYMENT INFORMATION</p>
                            <div class="hs-text-black hs-icon-text-container">No payment method defined, consider
                                inserting a method to facilitate payment
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:billing-new-personal-info-modal :modalIdName="'newPersonalInfoForm'" :user="auth()->user()"/>
            <livewire:billing-new-address-info-modal :modalIdName="'newAddressInfoForm'" :user="auth()->user()"/>
            <livewire:edit-billing-info-modal />
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

        document.getElementById('openEditBillingInfoModal').addEventListener('click', function () {
            let editAddressModal = new bootstrap.Modal(document.getElementById('editBillingInfoModal'));
            editAddressModal.show();
        });

    </script>
@endpush
