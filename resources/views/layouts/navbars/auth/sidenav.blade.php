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
                <a href="{{ route('dashboard') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('dashboard') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-graph-up text-dark text-lg"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <!-- Estates Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs uppercase font-bold text-gray-400">Estates</h6>
            </li>

            <!-- Estates Link -->
            <li>
                <a href="{{ route('estates.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('estates.index') || Route::is('estates.edit') || Route::is('estates.show') || Route::is('estates.create') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-house-door text-dark text-lg"></i>
                    <span class="ml-3">Estates</span>
                </a>
            </li>

            <!-- Users Section Header -->
            <li class="hs-mt-4">
                <h6 class="hs-px-3 hs-text-xs uppercase font-bold text-gray-400">Users</h6>
            </li>

            <!-- Profile Link -->
            <li>
                <a href="{{ route('profile') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('profile') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-person-fill text-dark text-lg"></i>
                    <span class="ml-3">Profile</span>
                </a>
            </li>

            <!-- Users Link -->
            <li>
                <a href="{{ route('users.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('users.index') || Route::is('users.edit') || Route::is('users.show') || Route::is('users.create') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
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
                <a href="{{ route('activities.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('activities.index') || Route::is('activities.edit') || Route::is('activities.show') || Route::is('activities.create') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-compass text-info text-lg"></i>
                    <span class="ml-3">Activities</span>
                </a>
            </li>

            <!-- Activity Types Link -->
            <li>
                <a href="{{ route('activity_types.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('activity_types.index') || Route::is('activity_types.edit') || Route::is('activity_types.show') || Route::is('activity_types.create') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-compass text-secondary text-lg"></i>
                    <span class="ml-3">Activity Types</span>
                </a>
            </li>

            <!-- Accommodations Link -->
            <li>
                <a href="{{ route('accommodations.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('accommodations.index') || Route::is('accommodations.edit') || Route::is('accommodations.show') || Route::is('accommodations.create') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-houses-fill text-danger text-lg"></i>
                    <span class="ml-3">Accommodations</span>
                </a>
            </li>

            <!-- Accommodation Types Link -->
            <li>
                <a href="{{ route('accommodation_types.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('accommodation_types.index') || Route::is('accommodation_types.edit') || Route::is('accommodation_types.show') || Route::is('accommodation_types.create') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-houses-fill text-secondary text-lg"></i>
                    <span class="ml-3">Accommodation Types</span>
                </a>
            </li>

            <!-- Categories Link -->
            <li>
                <a href="{{ route('categories.index') }}" class="flex items-center hs-p-3 hs-rounded-lg transition-colors {{ Route::is('categories.index') || Route::is('categories.edit') || Route::is('categories.create') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-lg">
                    <i class="bi bi-houses-fill text-secondary text-lg"></i>
                    <span class="ml-3">Categories</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
