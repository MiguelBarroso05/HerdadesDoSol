@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activities'])

    <div class="col-admin">
        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <div class="hs-col-12">
                    <!-- Success Message -->
                    <x-success-message />

                    <x-warning-message :session="'warning_activities'"/>

                    <!-- Card container for the Activities table -->
                    <div class="hs-card hs-mb-4">
                        <div class="hs-card-header hs-pb-0 hs-d-flex hs-justify-content-between">
                            <h6>Activities table</h6>
                            <!-- Search Bar -->
                            <x-search-bar :searchbarName="'search_activities'" />
                            <!-- Button to create a new activity -->
                            <x-custom-button type="createNew" route="{{ route('activities.create') }}"/>
                        </div>
                        <div class="hs-card-body hs-px-0 hs-pt-0 hs-pb-2">
                            <div class="hs-table-responsive hs-p-0">
                                <table class="hs-table hs-align-items-center hs-mb-0">
                                    <thead>
                                    <tr>
                                        <!-- Column headers -->
                                        <th class="hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Activity
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Type
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Last Update
                                        </th>
                                        <th class="hs-text-secondary hs-opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Loop through the $activities collection to display each activity -->
                                    @foreach($activities as $activity)
                                        <tr>
                                            <!-- Activity info column -->
                                            <td>
                                                <div class="hs-d-flex hs-px-2 hs-py-1">
                                                    <!-- Activity image -->
                                                    <div>
                                                        <img
                                                            src="{{ $activity->img ? asset('storage/'.$activity->img) : asset('/imgs/users/no-image.png') }}"
                                                            class="hs-avatar hs-avatar-sm hs-me-3" alt="Activity image">
                                                    </div>
                                                    <!-- Activity name -->
                                                    <div class="hs-d-flex hs-flex-column hs-justify-content-center">
                                                        <h6 class="hs-mb-0 hs-text-sm">{{ $activity->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Activity type column -->
                                            <td class="hs-align-middle hs-text-center">
                                        <span class="hs-text-secondary hs-text-xs hs-font-weight-bold">
                                            {{ $activity->activity_types->name }}
                                        </span>
                                            </td>

                                            <!-- Last update column -->
                                            <td class="hs-align-middle hs-text-center">
                                        <span class="hs-text-secondary hs-text-xs hs-font-weight-bold">
                                            {{ $activity->updated_at }}
                                        </span>
                                            </td>

                                            <!-- Action buttons -->
                                            <td class="hs-align-middle hs-d-flex hs-justify-content-evenly">
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
                                <div class="hs-d-flex hs-justify-content-center hs-mt-4">
                                    {{ $activities->links('vendor.pagination.custom') }}
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
