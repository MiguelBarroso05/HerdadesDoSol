<aside class="hs-bg-white hs-shadow-lg rounded-xl hs-my-3 fixed left-0 hs-top-0 hs-h-screen w-64 p-4 sidenav-admin">
    <!-- Sidebar header -->
    <div class="hs-mb-4">
        <a class="flex items-center hs-space-x-3" href="{{ route('home') }}">
            <img src="{{ asset('./imgs/logo/logo.png') }}" class="h-12" alt="main_logo">
            <span class="font-bold text-gray-700 side-logo">Herdades Do Sol</span>
        </a>
    </div>
    <!-- Horizontal divider -->
    <hr class="border-gray-300">

    <!-- Sidebar navigation -->
    <div class="hs-mt-4">
        <ul class="p-0">
            <!-- Dashboard Link -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center hs-p-2 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'home' ? 'hs-bg-gray-200 text-gray-900' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="ni ni-tv-2 text-primary text-lg"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <!-- estates Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs uppercase font-bold text-gray-400">Estates</h6>
            </li>

            <!-- estates Link -->
            <li>
                <a href="{{ route('estates.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'estates.index' ? 'bg-primary text-gray-900  rounded-md' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="fa-solid fa-house-chimney text-dark text-lg"></i>
                    <span class="ml-3">Estates</span>
                </a>
            </li>

            <!-- Users Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs uppercase font-bold text-gray-400">Users</h6>
            </li>

            <!-- Profile Link -->
            <li>
                <a href="{{ route('profile') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'profile' ? 'bg-primary text-gray-900  rounded-md' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="bi bi-person-fill text-dark text-lg"></i>
                    <span class="ml-3">Profile</span>
                </a>
            </li>

            <!-- Users Link -->
            <li>
                <a href="{{ route('users.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'users.index' ? 'bg-primary text-gray-900  rounded-md' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="bi bi-people-fill text-dark text-lg"></i>
                    <span class="ml-3">Users</span>
                </a>
            </li>

            <!-- Pages Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs uppercase font-bold text-gray-400">Pages</h6>
            </li>

            <!-- Activities Link -->
            <li>
                <a href="{{ route('activities.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'activities.index' ? 'bg-primary text-gray-900  rounded-md' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="bi bi-compass text-info text-lg"></i>
                    <span class="ml-3">Activities</span>
                </a>
            </li>

            <!-- Activity Types Link -->
            <li>
                <a href="{{ route('activity_types.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'activity_types.index' ? 'bg-primary text-gray-900  rounded-md' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="bi bi-compass text-secondary text-lg"></i>
                    <span class="ml-3">Activity Types</span>
                </a>
            </li>

            <!-- Accommodations Link -->
            <li>
                <a href="{{ route('accommodations.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'accommodations.index' ? 'bg-primary text-gray-900  rounded-md' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="bi bi-houses-fill text-danger text-lg"></i>
                    <span class="ml-3">Accommodations</span>
                </a>
            </li>

            <!-- Accommodation Types Link -->
            <li>
                <a href="{{ route('accommodation_types.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::currentRouteName() == 'accommodation_types.index' ? 'bg-primary text-gray-900  rounded-md' : 'hover:hs-bg-gray-100 text-gray-600' }}">
                    <i class="bi bi-houses-fill text-secondary text-lg"></i>
                    <span class="ml-3">Accommodation Types</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
