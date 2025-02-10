@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
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
                    <div class="hs-d-flex">
                        <div class="hs-row" style="height: 240px">
                            <div class="hs-row">
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Name:</strong>
                                        {{ limit_word(auth()->user()->firstname . ' ' . auth()->user()->lastname, 30, true) }}
                                    </p>
                                </div>
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Phone:</strong>
                                        {{ auth()->user()->phone ?? 'none'}}
                                    </p>
                                </div>
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">NIF:</strong>
                                        {{ auth()->user()->nif ?? 'none'}}
                                    </p>
                                </div>
                            </div>
                            <div class="hs-row">
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Nationality:</strong>
                                        {{ limit_word(auth()->user()->nationality, 16, true) }}
                                    </p>
                                </div>
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Standard Group:</strong>
                                        {{ auth()->user()->standard_group }}
                                    </p>
                                </div>
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Children nº:</strong>
                                        {{ auth()->user()->children }}
                                    </p>
                                </div>
                            </div>
                            <div class="hs-row">
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Birth Date:</strong>
                                        {{ auth()->user()->birthdate->format('d-m-Y')}}
                                    </p>
                                </div>
                                <div class="hs-col-md-8">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Email:</strong>
                                        {{ limit_word(auth()->user()->email, 50, false) }}
                                    </p>
                                </div>
                            </div>
                            <div class="hs-row">
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Fav Estate:</strong>
                                        {{ auth()->user()->fav_estate() ??  'none' }}
                                    </p>
                                </div>
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Preferences:</strong>
                                        {{ auth()->user()->preferences->isNotEmpty() ? auth()->user()->preferences->pluck('name')->implode(', ') : 'none' }}
                                    </p>
                                </div>
                            </div>
                            <div class="hs-row">
                                <div class="hs-col-md-4">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Language:</strong>
                                        {{ auth()->user()->language()->name }}
                                    </p>
                                </div>
                                <div class="hs-col-md-8">
                                    <p class="hs-d-flex"><strong class="hs-pe-2">Allergies:</strong>
                                        {{ auth()->user()->allergies->isNotEmpty() ? auth()->user()->allergies->pluck('name')->implode(', ') : 'none' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="hs-col-md-3 hs-text-end">
                            <img
                                src="{{ auth()->user()->img ? asset(auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                alt="" class="hs-img-fluid hs-rounded-3" style="width: 200px">
                        </div>
                    </div>
                </div>
                <livewire:show-addresses :user="auth()->user()"/>
            </div>
            @foreach(auth()->user()->addresses as $address)
                <x-show-address-modal :address="$address" :user="auth()->user()"/>
                @push('js')
                    <script>
                        document.getElementById('clickableDiv{{$address->id}}').addEventListener('click', function () {
                            let modal = new bootstrap.Modal(document.getElementById('addressModal{{$address->id}}'));
                            modal.show();
                        });
                    </script>
                @endpush
            @endforeach
            <livewire:address-form :user="auth()->user()" :modalIdName="'clientAddAddressModal'"
                                   :redirectUrl="url()->current()"/>
        </div>
    </main>
@endsection

