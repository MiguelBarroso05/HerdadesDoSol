@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="hs-col-md-11 hs-w-85 hs-align-self-center hs-mt-8 hs-p-2 hs-flex-grow-1">
        <x-success-message/>
        <div class="hs-d-flex hs-justify-content-between">
            <x-client-side-bar/>
            <div style="width: 78%; display:flex; justify-content:space-between;">
                <div class="hs-col-md-8">
                    <div class="hs-row" style="width: 95% !important; min-height: 400px">
                        <div class="hs-px-0 hs-rounded-3 hs-bg-card">
                            <div class="hs-py-3 hs-px-3 hs-w-100 hs-rounded-3 hs-text-white"
                                 style="background-color: #303030">
                                <i class="bi bi-person-fill hs-pe-3"></i>Personal Information
                            </div>
                            <div class="hs-px-6 hs-py-3">
                                <p class="text-secondary">BASIC INFORMATION</p>
                                <div class="hs-d-flex">
                                    <div class="hs-row w-full">
                                        <div class="hs-row">
                                            <div class="hs-col-md-7">
                                                <p><strong class="hs-pe-2">Name:</strong>
                                                    {{limit_word(auth()->user()->firstname . ' ' . auth()->user()->lastname, 40, true)}}
                                                </p>
                                            </div>
                                            <div class="hs-col-md-5">
                                                <p><strong
                                                        class="hs-pe-2">NIF:</strong>{{ auth()->user()->nif ?? 'none' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="hs-row">
                                            <div class="hs-col-md-7">
                                                <p class="hs-d-flex"><strong class="hs-pe-2">Birth Date:</strong>
                                                    {{ auth()->user()->birthdate->format('d-m-Y') }}</p>
                                            </div>
                                            <div class="hs-col-md-5">
                                                <p class="hs-d-flex"><strong
                                                        class="hs-pe-2">Phone:</strong>{{ auth()->user()->phone ?? 'none' }}</p>
                                            </div>
                                        </div>
                                        <div class="hs-row">
                                            <div class="hs-col-md-12">
                                                <p class="hs-d-flex"><strong class="hs-pe-2">Email:</strong>
                                                    {{  limit_word(auth()->user()->email, 50, false)  }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hs-col-md-3">
                                        <img
                                            src="{{ auth()->user()->img ? asset(auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                            alt="" class="hs-img-fluid hs-rounded-3 justify-self-end" style="width: 120px;">
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <p class="text-secondary">MAIN ADDRESS INFORMATION</p>
                                    @if(auth()->user()->addresses()->count() >= 1)
                                        <div class="hs-row">
                                            <div class="hs-col-md-5">
                                                <p class="hs-d-flex hs-pe-2"><strong class="hs-pe-2"
                                                    >Country:</strong>{{auth()->user()->addresses()->wherePivot('isFavorite', true)->first()->country ?? auth()->user()->addresses()->first()->country }}
                                                </p>
                                            </div>
                                            <div class="hs-col-md-7">
                                                <p class="hs-d-flex hs-pe-2"><strong class="hs-pe-2"
                                                    >City:</strong>{{auth()->user()->addresses()->wherePivot('isFavorite', true)->first()->city ?? auth()->user()->addresses()->first()->city}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="hs-row">
                                            <div class="hs-col-md-5">
                                                <p class="hs-d-flex hs-pe-2"><strong class="hs-pe-2"
                                                    >Postal-code:</strong>{{auth()->user()->addresses()->wherePivot('isFavorite', true)->first()->zipcode ?? auth()->user()->addresses()->first()->zipcode}}
                                                </p>
                                            </div>
                                            <div class="hs-col-md-7">
                                                <p class="hs-d-flex hs-pe-2"><strong class="hs-pe-2"
                                                    >Street:</strong>{{auth()->user()->addresses()->wherePivot('isFavorite', true)->first() ?
                                                    limit_word(auth()->user()->addresses()->wherePivot('isFavorite', true)->first()->street, 35, false) :
                                                    limit_word(auth()->user()->addresses()->first()->street, 35, false) }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="hs-col-md-6">
                                            <p class="hs-fw-bolder">Consider adding your preferred location to simplify
                                                your purchases</p>
                                        </div>
                                        <div class="hs-col-md-6 hs-d-flex hs-justify-content-end">
                                            <button
                                                type="button"
                                                id="teste"
                                                class="hs-btn hs-mb-0 hs-w-90 hs-h-100 hs-fs-3"
                                                style="box-shadow: none; border: 2px solid #437546; color: #437546;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#clientAddAddressModal">
                                                <i class="bi bi-plus-circle hs-fw-bolder"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <livewire:address-form
                        :user="auth()->user()"
                        :modalIdName="'clientAddAddressModal'"
                        :redirectUrl="url()->current()"/>
                    <div class="hs-row hs-mt-5" style="width: 95% !important">
                        <div class="hs-px-0 hs-rounded-3 hs-bg-card">
                            <div class="hs-py-3 hs-px-3 hs-w-100 hs-rounded-3 hs-text-black hs-bg-white">
                                <i class="bi bi-star hs-pe-3"></i>Wishlist
                            </div>
                            <div class="hs-row hs-d-flex hs-justify-content-around hs-mx-1">
                                <div class="hs-border hs-border-2 hs-my-2 hs-rounded-3 hs-p-3 hs-bg-white"
                                     style="width: 30%">
                                    <h6 class="hs-my-0" style="font-size: 24px">Activity</h6>
                                    <p class="hs-my-0">Hiking</p>
                                    <div class="hs-d-flex hs-justify-content-between">
                                        <div style="display: flex; justify-content: end; flex-direction: column">
                                            <p class="hs-my-0" style="font-size: 16px"><strong>1 Hour</strong></p>
                                            <p class="hs-my-0" style="font-size: 16px">Lorem</p>
                                        </div>
                                        <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="hs-rounded-3"
                                             style="width:70px">
                                    </div>
                                </div>
                                <div class="hs-border hs-border-2 hs-my-2 hs-rounded-3 hs-p-3 hs-bg-white"
                                     style="width: 30%">
                                    <h6 class="hs-my-0" style="font-size: 24px">Activity</h6>
                                    <p class="hs-my-0">Hiking</p>
                                    <div class="hs-d-flex hs-justify-content-between">
                                        <div style="display: flex; justify-content: end; flex-direction: column">
                                            <p class="hs-my-0" style="font-size: 16px"><strong>1 Hour</strong></p>
                                            <p class="hs-my-0" style="font-size: 16px">Lorem</p>
                                        </div>
                                        <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="hs-rounded-3"
                                             style="width:70px">
                                    </div>
                                </div>
                                <div class="hs-border hs-border-2 hs-my-2 hs-rounded-3 hs-p-3 hs-bg-white"
                                     style="width: 30%">
                                    <h6 class="hs-my-0" style="font-size: 24px">Activity</h6>
                                    <p class="hs-my-0">Hiking</p>
                                    <div class="hs-d-flex hs-justify-content-between">
                                        <div style="display: flex; justify-content: end; flex-direction: column">
                                            <p class="hs-my-0" style="font-size: 16px"><strong>1 Hour</strong></p>
                                            <p class="hs-my-0" style="font-size: 16px">Lorem</p>
                                        </div>
                                        <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="hs-rounded-3"
                                             style="width:70px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hs-col-md-4">
                    <div class="hs-row hs-m-0 min-h-[400px]">
                        <div class="hs-px-0 hs-rounded-3 hs-bg-card">
                            <div class="hs-py-3 hs-px-3 hs-w-100 hs-rounded-3 hs-text-white"
                                 style="background-color: #437546 !important">
                                <i class="bi bi-credit-card-2-back hs-pe-3"></i>Payment Method
                            </div>
                            <div class="hs-px-6 hs-py-2">
                                <div class="hs-row hs-mt-1" style="margin-bottom: 60px">
                                    @if(auth()->user()->paymentMethods->firstWhere('predefined', 1))
                                        <div class="hs-py-3">
                                            <p class="hs-d-flex  hs-align-items-center"><strong class="hs-pe-2">Method:</strong> <img class="w-[50px] h-auto"
                                                                                                               src="{{asset(auth()->user()->paymentMethods->firstWhere('predefined', 1)->type->img)}}"
                                                                                                               alt="{{auth()->user()->paymentMethods->firstWhere('predefined', 1)->type->name}} Logo"></p>
                                        </div>
                                        <p class="hs-d-flex"><strong class="hs-pe-2">Name:</strong> {{auth()->user()->paymentMethods->firstWhere('predefined', 1)->name}}
                                        </p>
                                        <p class="hs-d-flex"><strong class="hs-pe-2">Number: </strong> {{'**** **** ****'.auth()->user()->paymentMethods->firstWhere('predefined', 1)->last4}}
                                        </p>
                                        <div class="hs-d-flex hs-justify-content-between">
                                            <p class="hs-d-flex"><strong class="hs-pe-2">Validity: </strong> **/**</p>
                                        </div>
                                    @else
                                        <p class="pt-12 text-center">Payment method not defined</p>
                                    @endif

                                </div>
                                <div class="hs-d-flex hs-justify-content-center">
                                    <a href="{{route('payment-methods')}}" type="button" class="hs-btn hs-btn-light hs-d-flex hs-align-items-center"
                                            style="height: 31px">Payment Methods
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hs-row hs-m-0 hs-mt-5">
                        <div class="hs-px-0 hs-rounded-3 hs-bg-card">
                            <div class="hs-py-3 hs-px-3 hs-w-100 hs-rounded-3 hs-text-black hs-bg-white">
                                <i class="bi bi-book hs-pe-3"></i>Last Order
                            </div>
                            <div class="hs-row hs-p-0 hs-d-flex hs-justify-content-center">
                                <p class="hs-d-flex hs-justify-content-center hs-fw-bolder hs-m-0"
                                   style="font-size: 14px;">Order nº
                                    XD234FD112E</p>
                                <p class="hs-d-flex hs-justify-content-center hs-fw-bolder hs-m-0"
                                   style="font-size: 14px;">10
                                    Janeiro
                                    2024<!-- Order Date --></p>
                            </div>
                            <div class="hs-d-flex hs-justify-content-center hs-pt-2 hs-pb-3">
                                <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="hs-rounded-3"
                                     style="width:70px">
                            </div>
                            <div class="hs-d-flex hs-justify-content-center">
                                <button type="button" class="hs-btn hs-btn-light hs-d-flex hs-align-items-center"
                                        style="height: 31px">
                                    My Orders
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

