@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodations'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success Message -->
                @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show " role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <!-- Accommodations Table -->
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>Accommodations Table</h6>
                        <!-- Create New button -->
                        <x-custom-button type="createNew" route="{{ route('accommodations.create') }}"/>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <!-- Table Head -->
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Accommodation
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Size
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
                                @foreach($accommodations as $accommodation)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <!-- Image -->
                                                <div>
                                                    <img
                                                        src="{{ $accommodation->accommodation_types->img ? asset('storage/'.$accommodation->accommodation_types->img) : asset('/imgs/users/no-image.png') }}"
                                                        class="avatar avatar-sm me-3" alt="User image">
                                                </div>
                                                <!-- Id -->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Accommodation
                                                        #{{ $accommodation->id }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Type Name -->
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$accommodation->accommodation_types->name}}</span>
                                        </td>
                                        <!-- Size -->
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$accommodation->size}}</span>
                                        </td>
                                        <!-- Updated At -->
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$accommodation->updated_at}}</span>
                                        </td>

                                        <!-- Action Buttons -->
                                        <td class="align-middle d-flex justify-content-evenly">
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
                            <div class="d-flex justify-content-center mt-4">
                                {{ $accommodations->links('vendor.pagination.custom') }}
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



