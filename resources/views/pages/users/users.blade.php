@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'All Users'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <div class="col-admin">
        <div class="hs-container-fluid">
            <div class="hs-row">
                <div class="hs-col-12">
                    <!-- Card container for the Users table -->
                    <div class="hs-card hs-mb-4">
                        <div class="hs-card-header hs-pb-0 hs-d-flex hs-justify-content-between">
                            <div>
                                <h6>Users table</h6>
                            </div>
                            <!-- Search Bar -->
                            <div>
                                <x-search-bar searchbarName="search_users" />
                            </div>
                            <div>
                                <!-- Button Create New -->
                                <a href="{{ route('users.create') }}"
                                   class="hs-mx-2"
                                   data-toggle="tooltip">
                                    <i class="bi bi-person-add hs-fs-3"></i>
                                </a>
                            </div>
                        </div>

                        <div class="hs-card-body hs-px-0 hs-pt-0 hs-pb-2">
                            <!-- Table wrapper with responsive design -->
                            <div class="hs-table-responsive hs-p-0">
                                <table class="hs-table hs-align-items-center hs-mb-0">
                                    <!-- Table header -->
                                    <thead>
                                    <tr>
                                        <!-- Table column headers -->
                                        <th class="hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            User
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Role
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Status
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Activated/Disabled at
                                        </th>
                                        <th class="hs-text-secondary hs-opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Loop through the $users collection to display each user -->
                                    @foreach($users as $user)
                                        <tr>
                                            <!-- User info column -->
                                            <td>
                                                <div class="hs-d-flex hs-px-2 hs-py-1">
                                                    <!-- User profile image -->
                                                    <div>
                                                        <img
                                                            src="{{ $user->img ? asset($user->img) : asset('/imgs/users/no-image.png') }}"
                                                            class="hs-avatar hs-avatar-sm hs-me-3" alt="User image">
                                                    </div>
                                                    <!-- Username and email -->
                                                    <div class="hs-d-flex hs-flex-column hs-justify-content-center">
                                                        <h6 class="hs-mb-0 hs-text-sm">{{ $user->firstname }} {{ $user->lastname }}</h6>
                                                        <p class="hs-text-xs hs-text-secondary hs-mb-0">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- User role column -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{($user->user_roles->first()->name) ? $user->user_roles->first()->name : 'none' }}</span>
                                            </td>

                                            <!-- User status column -->
                                            <td class="hs-align-middle hs-text-center hs-text-sm">
                                                <!-- Status badge: Active or Inactive -->
                                                <span
                                                    class="hs-badge hs-badge-sm {{ is_null($user->deleted_at) ? 'hs-bg-gradient-success' : 'hs-bg-gradient-danger' }}">
                                                    {{ is_null($user->deleted_at) ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>

                                            <!-- User activation/disable date -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span class="hs-text-secondary hs-text-xs hs-font-weight-bold">
                                                    @if (is_null($user->deleted_at))
                                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'No date available' }}
                                                    @else
                                                        {{ $user->deleted_at ? $user->deleted_at->format('d/m/Y') : 'No date available' }}
                                                    @endif
                                                </span>
                                            </td>

                                            <!-- Action buttons -->
                                            <td class="hs-align-middle hs-d-flex hs-justify-content-evenly items-center min-h-[61px]">
                                                <!-- Show User button -->
                                                <x-custom-button type="show" route="{{ route('users.show', $user->id) }}"/>

                                                <!-- Edit User button -->
                                                <x-custom-button type="edit" route="{{ route('users.edit', $user) }}"/>

                                                <!-- Conditional: Disable or Activate User -->
                                                @if(is_null($user->deleted_at))
                                                    <!-- Disable user -->
                                                    <x-custom-button type="disable" route="{{ route('users.destroy', ['user' => $user]) }}" />
                                                @else
                                                    <!-- Activate user -->
                                                    <x-custom-button type="enable" route="{{ route('users.recover', ['user' => $user]) }}" />
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="hs-d-flex hs-justify-content-center hs-mt-4">
                                    {{ $users->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            <!-- Script to auto-hide the message -->
            document.addEventListener('DOMContentLoaded', function () {
                const alert = document.getElementById('success-alert') || document.getElementById('warning-alert');

                if (alert) {
                    setTimeout(() => {
                        alert.classList.remove('show');
                        alert.classList.add('fade');
                        setTimeout(() => {
                            alert.remove();
                        }, 300); // Fade-out animation
                    }, 3000); // 3 seconds
                }
            });
        </script>
    @endpush
@endsection
