@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodation Types'])

    <div class="col-admin">
        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <div class="hs-col-12">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div id="hs-success-alert" class="hs-alert hs-alert-success hs-alert-dismissible hs-fade hs-show " role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif

                    <!-- accommodation Types Table -->
                    <div class="hs-card hs-mb-4">
                        <div class="hs-card-header hs-pb-0 hs-d-flex hs-justify-content-between">
                            <h6>Accommodation Types Table</h6>
                            <!-- Create New button -->
                            <x-custom-button type="createNew" route="{{ route('accommodation_types.create') }}"/>
                        </div>
                        <div class="hs-card-body hs-px-0 hs-pt-0 hs-pb-2">
                            <div class="hs-table-responsive hs-p-0">
                                <table class="hs-table hs-align-items-center hs-mb-0">

                                    <!-- Table Head -->
                                    <thead>
                                    <tr>
                                        <th class="hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Accommodation Type
                                        </th>
                                        <th
                                            class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Last Update
                                        </th>
                                        <th class="hs-text-secondary hs-opacity-7"></th>
                                    </tr>
                                    </thead>

                                    <!-- Table Body -->
                                    <tbody>
                                    @foreach($accommodation_types as $accommodation_type)
                                        <tr>
                                            <td>
                                                <div class="hs-d-flex hs-px-2 hs-py-1">
                                                    <!-- Image -->
                                                    <div>
                                                        <img
                                                            src="{{ $accommodation_type->img ? asset('storage/'.$accommodation_type->img) : asset('/imgs/users/no-image.png') }}"
                                                            class="hs-avatar hs-avatar-sm hs-me-3" alt="#">
                                                    </div>
                                                    <!-- Name -->
                                                    <div class="hs-d-flex hs-flex-column hs-justify-content-center">
                                                        <h6 class="hs-mb-0 hs-text-sm">{{ $accommodation_type->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Updated At -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{$accommodation_type->updated_at}}</span>
                                            </td>
                                            <!-- Action Buttons -->
                                            <td class="hs-align-middle hs-d-flex hs-justify-content-evenly">
                                                <!-- Edit button -->
                                                <x-custom-button type="edit" route="{{ route('accommodation_types.edit', $accommodation_type) }}"/>

                                                <!-- Delete button -->
                                                <x-custom-button type="delete" route="{{ route('accommodation_types.destroy', ['accommodation_type' => $accommodation_type]) }}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="hs-d-flex hs-justify-content-center hs-mt-4">
                                    {{ $accommodation_types->links('vendor.pagination.custom') }}
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
                const successAlert = document.getElementById('hs-success-alert');

                if (successAlert) {
                    setTimeout(() => {
                        successAlert.classList.remove('hs-show');
                        successAlert.classList.add('hs-fade');
                        setTimeout(() => {
                            successAlert.remove();
                        }, 300); // Fade-out animation
                    }, 3000); // 3 seconds
                }
            });
        </script>
    @endpush
@endsection
