<aside class="hs-bg-white hs-shadow-lg hs-rounded-xl hs-my-3 hs-fixed hs-left-0 hs-top-0 hs-h-screen hs-w-64 hs-p-4" id="sidenav-main">
    <!-- Sidebar header -->
    <div class="hs-mb-4">
        <a class="hs-flex hs-items-center hs-space-x-3" href="{{ route('home') }}">
            <img src="{{ asset('./imgs/logo/logo.png') }}" class="hs-h-12" alt="main_logo">
            <span class="hs-font-bold hs-text-gray-700">Herdades Do Sol</span>
        </a>
    </div>
    <!-- Horizontal divider -->
    <hr class="hs-border-gray-300">

    <!-- Sidebar navigation -->
    <div class="hs-mt-4">
        <ul class="hs-space-y-2">
            <!-- Dashboard Link -->
            <li>
                <a href="{{ route('dashboard') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'home' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="ni ni-tv-2 text-primary text-lg"></i>
                    <span class="hs-ml-3">Dashboard</span>
                </a>
            </li>

            <!-- estates Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs hs-uppercase hs-font-bold hs-text-gray-400">Estates</h6>
            </li>

            <!-- estates Link -->
            <li>
                <a href="{{ route('estates.index') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'estates.index' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="fa-solid fa-house-chimney text-dark text-lg"></i>
                    <span class="hs-ml-3">Estates</span>
                </a>
            </li>

            <!-- Users Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs hs-uppercase hs-font-bold hs-text-gray-400">Users</h6>
            </li>

            <!-- Profile Link -->
            <li>
                <a href="{{ route('profile') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'profile' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="ni ni-single-02 text-dark text-lg"></i>
                    <span class="hs-ml-3">Profile</span>
                </a>
            </li>

            <!-- Users Link -->
            <li>
                <a href="{{ route('users.index') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'users.index' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="ni ni-single-02 text-dark text-lg"></i>
                    <span class="hs-ml-3">Users</span>
                </a>
            </li>

            <!-- Pages Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs hs-uppercase hs-font-bold hs-text-gray-400">Pages</h6>
            </li>

            <!-- Activities Link -->
            <li>
                <a href="{{ route('activities.index') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'activities.index' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="ni ni-compass-04 text-info text-lg"></i>
                    <span class="hs-ml-3">Activities</span>
                </a>
            </li>

            <!-- Activity Types Link -->
            <li>
                <a href="{{ route('activity_types.index') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'activity_types.index' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="ni ni-compass-04 text-secondary text-lg"></i>
                    <span class="hs-ml-3">Activity Types</span>
                </a>
            </li>

            <!-- Accommodations Link -->
            <li>
                <a href="{{ route('accommodations.index') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'accommodations.index' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="fa-solid fa-campground text-danger text-lg"></i>
                    <span class="hs-ml-3">Accommodations</span>
                </a>
            </li>

            <!-- Accommodation Types Link -->
            <li>
                <a href="{{ route('accommodation_types.index') }}" class="hs-flex hs-items-center hs-p-2 hs-rounded-lg hs-transition-colors {{ Route::currentRouteName() == 'accommodation_types.index' ? 'hs-bg-gray-200 hs-text-gray-900' : 'hover:hs-bg-gray-100 hs-text-gray-600' }}">
                    <i class="fa-solid fa-campground text-secondary text-lg"></i>
                    <span class="hs-ml-3">Accommodation Types</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
