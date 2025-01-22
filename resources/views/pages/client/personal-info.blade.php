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
    <main class="hs-col-md-11 hs-w-85 hs-align-self-center hs-mt-8 hs-p-2 hs-flex-grow-1">
        <div class="hs-d-flex hs-justify-content-between">
            <x-client-side-bar/>
            <div style="width: 78%;"
                 class="bg-card hs-rounded-3 hs-p-5 hs-d-flex hs-flex-column hs-justify-content-between">
                <div>
                    <div class="hs-d-flex hs-justify-content-between hs-w-100">
                        <p class="text-secondary">BASIC INFORMATION</p>
                        <x-custom-button type="edit" route="{{route('personal-info.edit', ['user'=>auth()->user()])}}"/>
                    </div>
                    <div class="hs-row" style="height: 240px">
                        <div class="hs-col-md-3 hs-d-flex hs-flex-column hs-justify-content-between">
                            <p class="hs-d-flex"><strong class="hs-pe-2">Name:</strong>
                                {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}
                            </p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Nationality:</strong>
                                {{ auth()->user()->nationality }}</p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Birth Date:</strong>
                                {{ auth()->user()->birthdate }}
                            </p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Allergies:</strong>
                                {{ auth()->user()->allergies->isNotEmpty() ? auth()->user()->allergies->pluck('name')->implode(', ') : 'none' }}
                            </p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Language:</strong>
                                {{ auth()->user()->language()->name }}
                            </p>
                        </div>
                        <div class="hs-col-md-3 hs-d-flex hs-flex-column hs-justify-content-between">
                            <p class="hs-d-flex"><strong class="hs-pe-2">Phone:</strong>
                                {{ auth()->user()->phone ?? 'none'}}
                            </p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Standard Group:</strong>
                                {{ auth()->user()->standard_group }}</p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Email:</strong>
                                {{ auth()->user()->email }}
                            </p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Preferences:</strong>
                                {{ auth()->user()->preferences->isNotEmpty() ? auth()->user()->preferences->pluck('name')->implode(', ') : 'none' }}
                            </p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Favourite Estates:</strong>
                                {{ auth()->user()->fav_estate ? auth()->user()->fav_estate : 'none' }}
                            </p>
                        </div>
                        <div class="hs-col-md-3 hs-d-flex hs-flex-column hs-justify-content-top">
                            <p class="hs-d-flex"><strong class="hs-pe-2">NIF:</strong>
                                {{ auth()->user()->nif ?? 'none'}}
                            </p>
                            <p class="hs-d-flex"><strong class="hs-pe-2">Children nº:</strong>
                                {{ auth()->user()->children }}</p>
                        </div>
                        <div class="hs-col-md-3 hs-text-end">
                            <img
                                src="{{ auth()->user()->img ? asset('storage/' . auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                alt="" class="hs-img-fluid hs-rounded-3" style="width: 200px">
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-secondary">ADDRESS INFORMATION</p>
                    <div class="hs-row hs-mx-auto hs-justify-content-between" style="min-height: 155px;">
                        @foreach(auth()->user()->addresses as $address)
                            <x-address-card :address="$address"/>
                        @endforeach

                        @if(auth()->user()->addresses->count() < 3)
                            <button type="button"
                                    class="hs-bg-white hs-p-3 hs-rounded-3 hs-d-flex hs-justify-content-center hs-align-items-center hs-fs-2"
                                    style="border: 1px dashed  #437546; width: 350px; height: 155px; color: #437546;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#clientAddAddressModal">
                                <i class="bi bi-plus-circle hs-fw-bolder"></i>
                            </button>
                        @endif

                        @if(auth()->user()->addresses->count() == 0)
                            <div class="hs-text-center hs-align-content-center" style="width: 350px; height: 155px;">
                                Consider adding your preferred location to simplify your purchases
                            </div>
                            <div class="hs-ms-2" style="width: 350px; height: 155px;"></div>

                        @elseif(auth()->user()->addresses->count() != 0)
                            @for ($i = auth()->user()->addresses->count(); $i < 2; $i++)
                                <div class="hs-ms-2" style="width: 350px; height: 155px;"></div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
            @foreach(auth()->user()->addresses as $address)
                <x-show-address-modal :address="$address" :user="auth()->user()"/>
            @endforeach
            <livewire:address-form :user="auth()->user()" :modalIdName="'clientAddAddressModal'"
                                   :redirectUrl="url()->current()"/>
        </div>
    </main>
@endsection
