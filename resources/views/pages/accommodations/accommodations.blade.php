@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodations'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="col-admin">
        <div class="hs-container-fluid">
            <div class="hs-row">
                <div class="hs-col-12">
                    <!-- Accommodations Table -->
                    <div class="hs-card hs-mb-4">
                        <div class="hs-card-header hs-pb-0 hs-d-flex hs-justify-content-between">
                            <h6>Accommodations Table</h6>

                            <!-- Search Bar -->
                            <x-search-bar :searchbarName="'search_accommodations'" />

                            <!-- Create New button -->
                            <x-custom-button type="createNew" route="{{ route('accommodations.create') }}"/>
                        </div>
                        <div class="hs-card-body hs-px-0 hs-pt-0 hs-pb-2">
                            <div class="hs-table-responsive hs-p-0">
                                <table class="hs-table hs-align-items-center hs-mb-0">
                                    <!-- Table Head -->
                                    <thead>
                                    <tr>
                                        <th class="hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Accommodation
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Type
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Size
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Last Update
                                        </th>
                                        <th class="hs-text-secondary hs-opacity-7"></th>
                                    </tr>
                                    </thead>

                                    <!-- Table Body -->
                                    <tbody>
                                    @foreach($accommodations as $accommodation)
                                        <tr>
                                            <td>
                                                <div class="hs-d-flex hs-px-2 hs-py-1">
                                                    <!-- Image -->
                                                    <div>
                                                        <img
                                                            src="{{ $accommodation->accommodation_types->img ? asset('storage/'.$accommodation->accommodation_types->img) : asset('/imgs/users/no-image.png') }}"
                                                            class="hs-avatar hs-avatar-sm hs-me-3" alt="User image">
                                                    </div>
                                                    <!-- Id -->
                                                    <div class="hs-d-flex hs-flex-column hs-justify-content-center">
                                                        <h6 class="hs-mb-0 hs-text-sm">Accommodation #{{ $accommodation->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Type Name -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{$accommodation->accommodation_types->name}}</span>
                                            </td>
                                            <!-- Size -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{$accommodation->size}}</span>
                                            </td>
                                            <!-- Updated At -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{$accommodation->updated_at}}</span>
                                            </td>

                                            <!-- Action Buttons -->
                                            <td class="hs-align-middle hs-d-flex hs-justify-content-evenly items-center min-h-[61px]">
                                                <!-- Show button -->
                                                <x-custom-button type="show" route="{{ route('accommodations.show', $accommodation) }}"/>

                                                <!-- Edit button -->
                                                <x-custom-button type="edit" route="{{ route('accommodations.edit', $accommodation) }}"/>

                                                <!-- Delete button -->
                                                <x-custom-button type="delete" route="{{ route('accommodations.destroy', ['accommodation' => $accommodation]) }}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="hs-d-flex hs-justify-content-center hs-mt-4">
                                    {{ $accommodations->links('vendor.pagination.custom') }}
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
            <!-- Script to auto-hide the success message -->
            document.addEventListener('DOMContentLoaded', function () {
                const successAlert = document.getElementById('success-alert');

                if (successAlert) {
                    setTimeout(() => {
                        successAlert.classList.remove('show');
                        successAlert.classList.add('fade');
                        setTimeout(() => {
                            successAlert.remove();
                        }, 300); // Fade-out animation
                    }, 3000); // 3 seconds
                }
            });
        </script>
    @endpush
@endsection
