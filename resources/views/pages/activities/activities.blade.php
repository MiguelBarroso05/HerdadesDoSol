@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activities'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success Message -->
                <x-success-message />

                <x-warning-message :session="'warning_activities'"/>

                <!-- Card container for the Activities table -->
                <div class="hs-card mb-4">
                    <div class="hs-card-header pb-0 d-flex justify-content-between">
                        <h6>Activities table</h6>
                        <!-- Search Bar -->
                        <x-search-bar :searchbarName="'search_activities'" />
                        <!-- Button to create a new activity -->
                        <x-custom-button type="createNew" route="{{ route('activities.create') }}"/>
                    </div>
                    <div class="hs-card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <!-- Column headers -->
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Activity
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Last Update
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Loop through the $activities collection to display each activity -->
                                @foreach($activities as $activity)
                                    <tr>
                                        <!-- Activity info column -->
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <!-- Activity image -->
                                                <div>
                                                    <img
                                                        src="{{ $activity->img ? asset('storage/'.$activity->img) : asset('/imgs/users/no-image.png') }}"
                                                        class="hs-avatar hs-avatar-sm me-3" alt="Activity image">
                                                </div>
                                                <!-- Activity name -->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $activity->name }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Activity type column -->
                                        <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $activity->activity_types->name }}
                                        </span>
                                        </td>

                                        <!-- Last update column -->
                                        <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $activity->updated_at }}
                                        </span>
                                        </td>

                                        <!-- Action buttons -->
                                        <td class="align-middle d-flex justify-content-evenly">
                                            <!-- Show button -->
                                            <x-custom-button type="show" route="{{ route('activities.show', $activity) }}"/>

                                            <!-- Edit button -->
                                            <x-custom-button type="edit" route="{{ route('activities.edit', $activity) }}"/>

                                            <!-- Delete button  -->
                                            <x-custom-button type="delete" route="{{ route('activities.destroy', ['activity' => $activity]) }}"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $activities->links('vendor.pagination.custom') }}
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
