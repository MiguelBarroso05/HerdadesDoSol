@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <!-- Include the top navigation bar with the title "All Users" -->
    @include('layouts.navbars.auth.topnav', ['title' => 'All estates'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success Message -->
                @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show " role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                @if(session('warning_users'))
                    <div id="warning-alert" class="alert alert-warning alert-dismissible fade show " role="alert">
                        <strong>Warning!</strong> {{ session('warning_users') }}
                    </div>
                @endif

                <!-- Card container for the Users table -->
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <div>
                            <h6>Estates table</h6>
                        </div>
                        <!-- Search Bar -->
                        <div>
                            <x-search-bar searchbarName="search_estates"/>
                        </div>
                        <div>
                            <!-- Button Create New -->
                            <x-custom-button type="createNew" route="{{ route('estates.create') }}"/>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <!-- Table wrapper with responsive design -->
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <!-- Table header -->
                                <thead>
                                <tr>
                                    <!-- Table column headers -->
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Location
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Activated/Disabled at
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Loop through the $estates collection to display each user -->
                                @foreach($estates as $estate)
                                    <tr>
                                        <!-- User info column -->
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <!-- User profile image -->
                                                <div>
                                                    <img
                                                        src="{{ $estate->img ? asset('storage/'.$estate->img) : asset('/imgs/users/no-image.png') }}"
                                                        class="avatar avatar-sm me-3" alt="User image">
                                                </div>
                                                <!-- Username and email -->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $estate->name }} </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $estate->address->city }}</h6>
                                                    <p class="mb-0 text-sm">{{ $estate->address->street }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- User status column -->
                                        <td class="align-middle text-center text-sm">
                                            <!-- Status badge: Active or Inactive -->
                                            <span
                                                class="badge badge-sm {{ is_null($estate->deleted_at) ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                                {{ is_null($estate->deleted_at) ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <!-- User activation/disable date -->
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                @if (is_null($estate->deleted_at))
                                                    {{ $estate->created_at ? $estate->created_at->format('d/m/Y') : 'No date available' }}
                                                @else
                                                    {{ $estate->deleted_at ? $estate->deleted_at->format('d/m/Y') : 'No date available' }}
                                                @endif
                                            </span>
                                        </td>

                                        <!-- Action buttons -->
                                        <td class="align-middle d-flex justify-content-evenly">
                                            <!-- Show User button -->
                                            <x-custom-button type="show" route="{{ route('estates.show', $estate) }}"/>

                                            <!-- Edit User button -->
                                            <x-custom-button type="edit" route="{{ route('users.edit', $estate) }}"/>

                                            <!-- Conditional: Disable or Activate User -->
                                            @if(is_null($estate->deleted_at))
                                                <!-- Disable user -->
                                                <form action="{{ route('users.destroy', ['user' => $estate]) }}"
                                                      method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-secondary btn-sm bg-gradient-danger"
                                                            data-toggle="tooltip" data-original-title="Disable user">
                                                        Disable
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Activate user -->
                                                <form action="{{ route('users.recover', ['user' => $estate]) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-secondary btn-sm bg-gradient-success"
                                                            data-toggle="tooltip" data-original-title="Activate user">
                                                        Activate
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
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
