<!-- Top Navbar -->
<nav>
    <div class="py-2 px-4 flex flex-wrap items-center justify-between top-nav-format">

        <!-- Navigation -->
        <ol class="flex space-x-2 text-sm text-white opacity-80 items-center">
            <li class="text-white">Pages</li>
            <li class="text-white">/</li>
            <li class="font-bold">{{ $title }}</li>
        </ol>

        <!-- Page Title -->
        <h6 class="font-bold text-white mt-1">{{ $title }}</h6>

        <!-- Search and Right Side Content -->
        <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="flex items-center bg-white rounded-lg shadow-sm">
                <x-search-bar :searchbarName="'adminSearchbar'"/>
            </div>

            <!-- Logout Button -->
            <form method="post" action="{{ route('logout') }}" id="logout-form" class="hs-p-2 top-nav-form">
                @csrf
                <a href="{{ route('logout') }} " class="top-nav-form-color text-white"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right hs-me-3 hs-fs-5"></i>Logout
                </a>
            </form>
        </div>
    </div>
</nav>
