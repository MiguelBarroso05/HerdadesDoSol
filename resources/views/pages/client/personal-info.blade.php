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
    </style>
    <main class="col-md-11 w-85 align-self-center mt-8 p-2  flex-grow-1">
        <div class="d-flex justify-content-between">
            <x-client-side-bar/>
            <div style="width: 78%;" class="bg-card rounded-3 p-5 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between w-100">
                        <p>BASIC INFORMATION</p>
                        <a href="" style="font-size: 1.5rem;"><i class="bi bi-pencil-square"></i></a>
                    </div>
                    <div class="row" style="height: 240px">
                        <div class="col-md-3 d-flex flex-column justify-content-between">
                            <p class="d-flex"><strong class="pe-2">Name:</strong>
                                {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}
                            </p>
                            <p class="d-flex"><strong class="pe-2">Nationality:</strong>
                                {{ auth()->user()->nationality }}</p>
                            <p class="d-flex"><strong class="pe-2">Birth Date:</strong>
                                {{ auth()->user()->birthdate }}
                            </p>
                            <p class="d-flex"><strong class="pe-2">Allergies:</strong>
                                {{ auth()->user()->allergies->isNotEmpty() ? auth()->user()->allergies->pluck('name')->implode(', ') : 'none' }}
                            </p>
                            <p class="d-flex"><strong class="pe-2">Language:</strong>
                                {{ auth()->user()->language()->name }}
                            </p>
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-between">
                            <p class="d-flex"><strong class="pe-2">Phone:</strong>
                                {{ auth()->user()->phone ?? 'none'}}
                            </p>
                            <p class="d-flex"><strong class="pe-2">Standard Group:</strong>
                                {{ auth()->user()->standard_group }}</p>
                            <p class="d-flex"><strong class="pe-2">Email:</strong>
                                {{ auth()->user()->email }}
                            </p>
                            <p class="d-flex"><strong class="pe-2">Preferences:</strong>
                                {{ auth()->user()->preferences->isNotEmpty() ? auth()->user()->preferences->pluck('name')->implode(', ') : 'none' }}
                            </p>
                            <p class="d-flex"><strong class="pe-2">Favourite Estates:</strong>
                                {{ auth()->user()->fav_estates->isNotEmpty() ? auth()->user()->fav_estates->pluck('name')->implode(', ') : 'none' }}
                            </p>
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-top">
                            <p class="d-flex"><strong class="pe-2">NIF:</strong>
                                {{ auth()->user()->nif ?? 'none'}}
                            </p>
                            <p class="d-flex"><strong class="pe-2">Children nº:</strong>
                                {{ auth()->user()->children }}</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <img
                                src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('/imgs/users/no-image.png') }}"
                                alt="" class="img-fluid rounded-3" style="width: 200px">
                        </div>
                    </div>
                </div>
                <div>
                    <p>ADDRESS INFORMATION</p>
                    <div class="row mx-auto justify-content-between" style="min-height: 155px;">
                        @foreach(auth()->user()->addresses as $address)
                            <x-address-card :address="$address"/>
                        @endforeach

                        @if(auth()->user()->addresses->count() < 3)
                            <button type="button"
                                    class="bg-white p-3 rounded-3 d-flex justify-content-center align-items-center fs-2 ms-2"
                                    style="border: 1px dashed  #437546; width: 350px; height: 155px; color: #437546;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#clientAddAddressModal">
                                <i class="bi bi-plus-circle fw-bolder"></i>
                            </button>
                        @endif

                        @for ($i = count(auth()->user()->addresses); $i < 2; $i++)
                            <div class="ms-2" style="width: 350px; height: 155px;"></div>
                        @endfor

                    </div>
                </div>
            </div>
            @foreach(auth()->user()->addresses as $address)
                <livewire:show-address-modal :address="$address" :user="auth()->user()" />
            @endforeach
            <livewire:address-form :user="auth()->user()" :modalIdName="'clientAddAddressModal'"
                                   :redirectUrl="url()->current()"/>
        </div>
    </main>
@endsection
