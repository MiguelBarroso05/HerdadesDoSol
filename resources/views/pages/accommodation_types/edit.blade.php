@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'accommodation Type'])
    <!-- Edit Form -->
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('accommodation_types.update', $accommodation_type->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- accommodation Type Card -->
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <!-- accommodation Type Image Section -->
                            <div class="col-auto">
                                <div class="avatar avatar-xl position-relative">
                                    <!-- Display accommodation type image or a default image if not available -->
                                    <img
                                        src="{{ $accommodation_type->img ? asset('storage/'.$accommodation_type->img) : asset('/imgs/users/no-image.png') }}"
                                        alt="profile_image" class="border-radius-lg shadow-sm">
                                </div>
                            </div>
                            <!-- accommodation Type Name Section -->
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        {{$accommodation_type->name}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    <x-general-errors />

                    <!-- accommodation Type Information Card -->
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Edit Accommodation Type</p>

                                <!-- Action Buttons -->
                                <div>
                                    <!-- Update button -->
                                    <x-custom-button type="update" route={{null}}/>
                                    <!-- Cancel button -->
                                    <x-custom-button type="cancel" route="{{route('accommodation_types.index')}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- accommodation Type Information Section -->
                            <p class="text-uppercase text-sm">Information</p>
                            <div class="row">
                                <!-- accommodation Type Image Upload -->
                                <div class="col-md-6">
                                    <label class="form-control-label">Image</label>
                                    <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                           accept="image/*">
                                </div>

                                <!-- accommodation Type Name Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                               name="name" value="{{ old('name', $accommodation_type->name) }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


