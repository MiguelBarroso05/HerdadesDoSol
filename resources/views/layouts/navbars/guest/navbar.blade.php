@php
    use App\Models\accommodation\AccommodationType;
    $accommodation_types = AccommodationType::all();
    $user = auth()->user();
@endphp

<div class="container sticky top-0 z-50 mx-auto max-w-6xl">
    <div class="row">
        <div class="tw-columns-12">
            <!-- Navbar -->
            <nav class="flex items-center justify-between bg-white shadow-md rounded-lg py-4 px-6 mt-4">
                <div class="flex items-center space-x-4">
                    <a class="flex items-center space-x-2 font-bold text-black" href="{{ route('home') }}">
                        <img src="{{ asset('../imgs/logo/logo.png') }}" alt="Logo" class="h-10">
                        <span class="text-xl">Herdades do Sol</span>
                    </a>
                </div>
                <div class="flex-grow max-w-md mx-auto">
                    <!-- Search Bar -->
                    <x-search-bar :searchbarName="'nome a definir'" />
                </div>
                <ul class="flex items-center space-x-6">
                    <!-- Dropdown Menu for Accommodations -->
                    <li class="relative group">
                        <button class="text-black font-bold">Accommodations</button>
                        <ul class="absolute left-0 hidden group-hover:block bg-white shadow-md rounded-lg py-2 w-48">
                            <li class="px-4 py-2 hover:bg-gray-100"><a href="{{ route('client.accommodations.index') }}">All</a></li>
                            @foreach($accommodation_types as $accommodation_type)
                                <li class="px-4 py-2 hover:bg-gray-100">
                                    <a href="#">{{ $accommodation_type->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Activities -->
                    <li><a href="#" class="text-black font-bold">Activities</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-black font-bold">Products</a></li>
                    <li><a href="#" class="text-black font-bold">Locations</a></li>

                    <!-- Cart -->
                    <li>
                        <a href="#" class="text-black text-lg">
                            <i class="bi bi-cart3"></i>
                        </a>
                    </li>

                    @auth
                        <!-- Notifications -->
                        <li class="relative group">
                            <button class="text-black text-lg">
                                <i class="bi bi-bell"></i>
                            </button>
                            <ul class="absolute right-0 hidden group-hover:block bg-white shadow-md rounded-lg py-2 w-56">
                                @foreach($user->notifications as $notification)
                                    <li class="px-4 py-2 hover:bg-gray-100">
                                        {{ $notification->data['subject'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <!-- User Profile Dropdown -->
                        <li class="relative group">
                            <button>
                                <img
                                    class="rounded-full w-8 h-8 object-cover"
                                    src="{{ auth()->user()->img ? asset('storage/' . auth()->user()->img) : asset('/imgs/users/no-image.png') }}"
                                    alt="Avatar"
                                >
                            </button>
                            <ul class="absolute right-0 hidden group-hover:block bg-white shadow-md rounded-lg py-2 w-56">
                                <li class="px-4 py-2 hover:bg-gray-100">
                                    {{ auth()->user()->firstname . ' ' . auth()->user()->lastname . ' - ' . auth()->user()->balance . '$' }}
                                </li>
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="{{ route('account') }}">Profile</a></li>
                                <li class="px-4 py-2 hover:bg-gray-100">
                                    <a href="#" data-modal-toggle="notificationsModal">Notifications</a>
                                </li>
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="#">Orders</a></li>
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="#">Wishlist</a></li>
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="#">History</a></li>
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="#">Help</a></li>
                                <li class="px-4 py-2 hover:bg-gray-100">
                                    <form method="post" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                    @guest
                        <!-- Guest Options -->
                        <li class="relative group">
                            <button class="text-lg">
                                <i class="bi bi-person"></i>
                            </button>
                            <ul class="absolute right-0 hidden group-hover:block bg-white shadow-md rounded-lg py-2 w-48">
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="{{ route('login') }}">Login</a></li>
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="{{ route('register') }}">Register</a></li>
                                <li class="px-4 py-2 hover:bg-gray-100"><a href="#">Help</a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>
