@php
   $user = auth()->user();
@endphp

<div class="hs-container hs-position-sticky hs-z-index-sticky hs-top-0" style="max-width: 1650px !important;">
    <div class="hs-row">
        <div class="hs-col-12">
            <!-- Navbar -->
            <nav
                class="hs-navbar hs-navbar-expand-lg hs-border-radius-lg hs-top-0 hs-z-index-3 hs-shadow hs-position-absolute hs-mt-4 hs-py-2 hs-start-0 hs-end-0 hs-mx-3 hs-bg-white">
                <div class="hs-container-fluid">
                    <div class="hs-d-flex hs-align-items-center hs-col-4">
                        <a class="hs-navbar-brand hs-font-weight-bolder hs-ms-lg-0 hs-d-flex hs-align-items-center"
                           href="{{ route('home') }}">
                            <img src="{{ asset('../imgs/logo/logo.png') }}" class="logo">
                            <span class="hs-fs-5 hs-fw-bolder hs-align-middle hs-text-black hs-ms-4">Herdades do
                                Sol</span>
                        </a>
                        <i class="ni ni-world hs-align-items-center "></i>
                    </div>
                    <div class="hs-input-group hs-col-4 hs-w-20">
                        <!-- Search Bar -->
                        <x-search-bar :searchbarName="'nome a definir'"/>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="hs-navbar-nav hs-justify-content-end hs-col-4">
                        <li class="hs-nav-item hs-dropdown hs-pe-3 hs-d-flex hs-align-items-center">
                            <a href="{{ route('accommodations.index') }}"
                               class="hs-nav-link hs-text-black hs-p-0 @if(Route::is('accommodations.index')) hs-fw-bold @endif">
                                Accommodations
                            </a>
                        </li>
                        <li class="hs-nav-item hs-dropdown hs-pe-3 hs-d-flex hs-align-items-center">
                            <a href="{{route('activities.client.index')}}" class="hs-nav-link hs-text-black @if(Route::is('activities.client.index')) hs-fw-bold @endif hs-p-0">
                                Activities
                            </a>
                        </li>
                        <li class="hs-nav-item hs-dropdown hs-pe-3 hs-d-flex hs-align-items-center">
                            <a href="{{ route('products.index') }}" class="hs-nav-link hs-text-black @if(Route::is('products.index')) hs-fw-bold @endif hs-p-0">
                                Products
                            </a>
                        </li>
                        <li class="hs-nav-item hs-dropdown hs-pe-3 hs-d-flex hs-align-items-center">
                            <a href="{{ session()->has('reservation') ? route('checkout', ['isReservation' => true]) : route('reservation.create') }}"
                               class="hs-nav-link hs-text-black @if(Route::is('reservation.create')) hs-fw-bold @endif hs-p-0">
                                Reservations
                            </a>
                        </li>
                        <li class="hs-nav-item hs-dropdown hs-pe-3 hs-d-flex hs-align-items-center hs-ps-4">

                            <livewire:CartComponent/>
                        </li>
                        @auth()
                            <!-- User img with dropdown -->
                            <li class="hs-nav-item hs-dropdown hs-d-flex left-5">
                                <x-dropdown class="dropdown-auth" height="h-[325px]">
                                    <x-slot name="trigger">
                                        <img class="hs-rounded-circle"
                                             style="width: 30px; height: 30px; object-fit: fill"
                                             src="{{ auth()->user()->img ? asset(auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                             alt="Avatar">
                                    </x-slot>
                                    <x-dropdown.item class="hs-justify-content-between hs-mx-2">
                                        <p class="hs-m-0 pe-2">
                                            {{ limit_word(auth()->user()->firstname . ' ' . auth()->user()->lastname, 22, true) }}
                                        </p>
                                        <p class="hs-m-0">
                                            {{ auth()->user()->balance . "$" }}
                                        </p>
                                    </x-dropdown.item>
                                    <x-dropdown.item icon="user" separator href="{{ route('account') }}">
                                        Profile
                                    </x-dropdown.item>
                                    <x-dropdown.item icon="bell" id="notifications-button">
                                        Notifications
                                        @if (auth()->user()->unreadNotifications->count() > 0)
                                            <div
                                                class="absolute top-0 right-1 w-4 h-4 rounded-full bg-red-600 flex justify-center items-center"
                                                style="top: 97px;right: 52px;">
                                                <p class="text-white m-0"
                                                   style="font-size: 10px">{{ auth()->user()->unreadNotifications->count() }}</p>
                                            </div>

                                        @endif
                                    </x-dropdown.item>
                                    <x-dropdown.item icon="book-open" href="{{ route('orders.index') }}">
                                        Orders
                                    </x-dropdown.item>
                                    <x-dropdown.item icon="star">
                                        Wishlist
                                    </x-dropdown.item>
                                    <x-dropdown.item icon="bookmark">
                                        History
                                    </x-dropdown.item>
                                    <x-dropdown.item icon="question-mark-circle" separator>
                                        Help
                                    </x-dropdown.item>
                                    <form method="post" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" class="hs-w-100">
                                            <x-dropdown.item icon="arrow-right-end-on-rectangle">
                                                Logout
                                            </x-dropdown.item>
                                        </button>
                                    </form>
                                </x-dropdown>

                                <div id="notifications-dropdown"
                                     class="hs-bg-white hs-shadow hs-py-3 hs-border-radius-md hs-d-none"
                                     style="position: absolute; top: 55px; left: -229px; width: 280px; z-index: 999; max-height: 400px; overflow-y: hidden; max-width: 280px">
                                    <div class="hs-d-flex hs-align-items-center hs-flex-column">
                                        <p class="hs-mb-2">Notifications</p>
                                        <div style="width: 100%; height: 1px; background-color: #D9D9D9"></div>
                                    </div>
                                    <ul style="list-style-type:disc;">
                                        @if (auth()->user()->unreadNotifications->count() > 0)

                                            @foreach (auth()->user()->unreadNotifications as $notification)
                                                @php
                                                    $notification->markAsRead();
                                                @endphp
                                                <li class="hs-py-2 hs-pe-1">
                                                    <h6 class="hs-m-0" style="font-size: 15px">
                                                        {{ $notification->data['subject'] }}</h6>
                                                    <p class="hs-m-0"
                                                       style="font-size: 12px">{{ $notification->data['body'] }}
                                                    </p>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="hs-py-2 hs-pe-1">
                                                <h6 class="hs-m-0" style="font-size: 15px">
                                                    You don't have any unread notifications</h6>

                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>

                        @endauth

                        @guest()
                            <!-- User icon with dropdown -->
                            <li class="hs-nav-item hs-dropdown hs-d-flex hs-justify-content-center hs-align-items-center">

                                <x-dropdown position="bottom" width="w-[203px]" class="dropdown-guest">
                                    <x-slot name="trigger">
                                        <i class="bi bi-person" style="font-size: 20px !important;"></i>
                                    </x-slot>
                                    <x-dropdown.item href="{{ route('login') }}">
                                        <i class="bi bi-check2-square hs-me-2" style="font-size: 18px !important;"></i>
                                        Login
                                    </x-dropdown.item>
                                    <x-dropdown.item separator href="{{ route('register') }}">
                                        <i class="bi bi-plus-circle hs-me-2" style="font-size: 18px !important;"></i>
                                        Register
                                    </x-dropdown.item>
                                    <x-dropdown.item separator>
                                        <i class="bi bi-question-circle hs-me-2"
                                           style="font-size: 18px !important;"></i>
                                        Help
                                    </x-dropdown.item>
                                </x-dropdown>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationsButton = document.getElementById('notifications-button');
            const notificationsDropdown = document.getElementById('notifications-dropdown');

            // Toggle the visibility of the notifications dropdown
            notificationsButton.addEventListener('click', function () {
                if (notificationsDropdown.classList.contains('hs-d-none')) {
                    notificationsDropdown.classList.remove('hs-d-none');
                    notificationsDropdown.classList.add('hs-d-block');
                } else {
                    notificationsDropdown.classList.remove('hs-d-block');
                    notificationsDropdown.classList.add('hs-d-none');
                }
            });

            // Optional: Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!notificationsButton.contains(event.target) &&
                    !notificationsDropdown.contains(
                        event.target)) {
                    notificationsDropdown.classList.add('hs-d-none');
                    notificationsDropdown.classList.remove('hs-d-block');
                }
            });
        });
    </script>
@endpush
