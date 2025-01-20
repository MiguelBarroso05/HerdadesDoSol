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
    </style>
    <main class="w-11/12 md:w-11/12 mx-auto mt-8 p-2 flex-grow">
        <x-success-message/>
        <div class="flex justify-between">
            <x-client-side-bar />
            <div class="w-4/5 flex justify-between">
                <div class="w-full md:w-8/12">
                    <div class="flex w-full min-h-[400px]">
                        <div class="px-0 rounded-3xl bg-card">
                            <div class="py-3 px-3 bg-[#303030] w-full rounded-3xl text-white">
                                Personal Information
                            </div>
                            <div class="px-6 py-3">
                                <p>BASIC INFORMATION</p>
                                <div class="flex flex-wrap mb-3">
                                    <div class="w-5/12">
                                        <p class="flex"><strong class="pr-2">Name:</strong>
                                            {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}
                                        </p>
                                        <p class="flex"><strong class="pr-2">Birth Date:</strong>
                                            {{ auth()->user()->birthdate }}</p>
                                        <p class="flex"><strong class="pr-2">Email:</strong>
                                            {{ auth()->user()->email }}
                                        </p>
                                    </div>
                                    <div class="w-4/12">
                                        <p class="flex"><strong class="pr-2">NIF:</strong>{{ auth()->user()->nif ?? 'none' }}</p>
                                        <p class="flex"><strong class="pr-2">Phone:</strong>{{ auth()->user()->phone ?? 'none' }}</p>
                                    </div>
                                    <div class="w-3/12 text-right">
                                        <img
                                            src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('/imgs/users/no-image.png') }}"
                                            alt="" class="img-fluid rounded-3xl" style="width: 100px">
                                    </div>
                                </div>
                                <div class="flex flex-wrap">
                                    <p>MAIN ADDRESS INFORMATION</p>
                                    @if(auth()->user()->addresses()->first())
                                        <div class="w-5/12">
                                            <p class="flex pr-2"><strong class="pr-2"
                                                >Country:</strong>{{auth()->user()->addresses()->first()->country}}
                                            </p>
                                            <p class="flex pr-2"><strong class="pr-2"
                                                >Postal-code:</strong>{{auth()->user()->addresses()->first()->zipcode}}
                                            </p>
                                        </div>
                                        <div class="w-7/12">
                                            <p class="flex pr-2"><strong class="pr-2"
                                                >City:</strong>{{auth()->user()->addresses()->first()->city}}
                                            </p>
                                            <p class="flex pr-2"><strong class="pr-2"
                                                >Address:</strong>{{auth()->user()->addresses()->first()->street}}
                                            </p>
                                        </div>
                                    @else
                                        <div class="w-6/12">
                                            <p class="font-bold">Consider adding your preferred location to simplify
                                                your purchases</p>
                                        </div>
                                        <div class="w-6/12 flex justify-end">
                                            <button type="button" class="btn mb-0 w-9/12 h-100 text-3xl"
                                                    style="box-shadow: none; border: 2px solid #437546; color: #437546;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#clientAddAddressModal">
                                                <i class="bi bi-plus-circle font-bold"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <livewire:address-form :user="auth()->user()" :modalIdName="'clientAddAddressModal'" :redirectUrl="url()->current()"/>
                    <div class="row mt-5 w-full">
                        <div class="px-0 rounded-3xl bg-card">
                            <div class="py-3 px-3 bg-white w-full rounded-3xl text-black">
                                Wishlist
                            </div>
                            <div class="flex justify-around mx-1">
                                <div class="border-2 my-2 rounded-3xl p-3 bg-white w-1/3">
                                    <h6 class="my-0 text-xl">Activity</h6>
                                    <p class="my-0">Hiking</p>
                                    <div class="flex justify-between">
                                        <div class="flex flex-col items-end">
                                            <p class="my-0 text-lg"><strong>1 Hour</strong></p>
                                            <p class="my-0 text-lg">Lorem</p>
                                        </div>
                                        <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="rounded-3xl"
                                             style="width:70px">
                                    </div>
                                </div>
                                <div class="border-2 my-2 rounded-3xl p-3 bg-white w-1/3">
                                    <h6 class="my-0 text-xl">Activity</h6>
                                    <p class="my-0">Hiking</p>
                                    <div class="flex justify-between">
                                        <div class="flex flex-col items-end">
                                            <p class="my-0 text-lg"><strong>1 Hour</strong></p>
                                            <p class="my-0 text-lg">Lorem</p>
                                        </div>
                                        <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="rounded-3xl"
                                             style="width:70px">
                                    </div>
                                </div>
                                <div class="border-2 my-2 rounded-3xl p-3 bg-white w-1/3">
                                    <h6 class="my-0 text-xl">Activity</h6>
                                    <p class="my-0">Hiking</p>
                                    <div class="flex justify-between">
                                        <div class="flex flex-col items-end">
                                            <p class="my-0 text-lg"><strong>1 Hour</strong></p>
                                            <p class="my-0 text-lg">Lorem</p>
                                        </div>
                                        <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="rounded-3xl"
                                             style="width:70px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-4/12 flex">
                    <div class="flex flex-wrap">
                        <div class="px-0 rounded-3xl bg-card">
                            <div class="py-3 px-3 bg-[#437546] w-full rounded-3xl text-white">
                                Payment Method
                            </div>
                            <div class="px-6 py-3">
                                <div class="flex mt-1 mb-12">
                                    <div class="py-3">
                                        <p class="flex"><strong class="pr-2">Method:</strong></p>
                                    </div>
                                    <p class="flex"><strong class="pr-2">Name:</strong></p>
                                    <p class="flex"><strong class="pr-2">Number:</strong></p>
                                    <div class="flex justify-between">
                                        <p class="flex"><strong class="pr-2">Expiration Date: 24/07</strong></p>
                                        <p class="flex"><strong class="pr-2">CVV: ***</strong></p>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="button" class="btn btn-light flex items-center h-8">
                                        Payment Methods
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-5">
                        <div class="px-0 rounded-3xl bg-card">
                            <div class="py-3 px-3 bg-white w-full rounded-3xl text-black">
                                Last Order
                            </div>
                            <div class="flex justify-center py-2">
                                <p class="flex justify-center font-bold m-0 text-sm">Order nº
                                    XD234FD112E</p>
                                <p class="flex justify-center font-bold m-0 text-sm">10 Janeiro 2024<!-- Order Date --></p>
                            </div>
                            <div class="flex justify-center py-2">
                                <img src="{{ asset('/imgs/users/no-image.png') }}" alt="" class="rounded-3xl"
                                     style="width:70px">
                            </div>
                            <div class="flex justify-center">
                                <button type="button" class="btn btn-light flex items-center h-8">
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

