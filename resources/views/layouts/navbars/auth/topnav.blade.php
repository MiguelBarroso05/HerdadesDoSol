<!-- Top Navbar -->
<nav class="bg-transparent shadow-none rounded-lg" id="navbarBlur" data-scroll="false">
    <div class="container mx-auto py-2 px-4 flex flex-wrap items-center justify-between">

        <!-- Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="flex space-x-2 text-sm text-white opacity-80">
                <li>
                    <a href="javascript:;" class="hover:opacity-100">Pages</a>
                </li>
                <li class="text-white">/</li>
                <li class="font-bold">{{ $title }}</li>
            </ol>
            <!-- Page Title -->
            <h6 class="font-bold text-white mt-1">{{ $title }}</h6>
        </nav>

        <!-- Search and Right Side Content -->
        <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="flex items-center bg-white rounded-lg shadow-sm">
                <span class="px-2 text-gray-500">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-input border-none focus:ring-0 focus:outline-none px-2 py-1" placeholder="Type here...">
            </div>

            <!-- Navbar Items -->
            <ul class="flex items-center space-x-4">
                <!-- Logout Button -->
                <li>
                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="text-white font-bold flex items-center space-x-2">
                            <i class="fa fa-user"></i>
                            <span class="hidden sm:inline">Log out</span>
                        </a>
                    </form>
                </li>

                <!-- Sidenav Toggler -->
                <li class="block xl:hidden">
                    <a href="javascript:;" class="text-white p-2" id="iconNavbarSidenav">
                        <div class="space-y-1">
                            <div class="w-5 h-0.5 bg-white"></div>
                            <div class="w-5 h-0.5 bg-white"></div>
                            <div class="w-5 h-0.5 bg-white"></div>
                        </div>
                    </a>
                </li>

                <!-- Settings Icon -->
                <li>
                    <a href="javascript:;" class="text-white p-2">
                        <i class="fa fa-cog"></i>
                    </a>
                </li>

                <!-- Notifications Dropdown -->
                <li class="relative">
                    <a href="javascript:;" class="text-white p-2" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                    </a>
                    <ul class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg overflow-hidden">
                        @foreach(auth()->user()->notifications as $notification)
                            <li class="p-2 border-b last:border-none">
                                <p class="text-sm text-gray-700">{{ $notification->data['subject'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
