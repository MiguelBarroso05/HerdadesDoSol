@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodation Types'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success Message -->
                @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show " role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <!-- accommodation Types Table -->
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>Accommodation Types Table</h6>
                        <!-- Create New button -->
                        <x-custom-button type="createNew" route="{{ route('accommodation_types.create') }}"/>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">

                                <!-- Table Head -->
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Accommodation Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Last Update
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                @foreach($accommodation_types as $accommodation_type)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <!-- Image -->
                                                <div>
                                                    <img
                                                        src="{{ $accommodation_type->img ? asset('storage/'.$accommodation_type->img) : asset("/imgs/users/no-image.png") }}"
                                                        class="avatar avatar-sm me-3" alt="#">
                                                </div>
                                                <!-- Name -->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $accommodation_type->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Updated At -->
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$accommodation_type->updated_at}}</span>
                                        </td>
                                        <!-- Action Buttons -->
                                        <td class="align-middle d-flex justify-content-evenly">
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
                            <div class="d-flex justify-content-center mt-4">
                                {{ $accommodation_types->links('vendor.pagination.custom') }}
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



