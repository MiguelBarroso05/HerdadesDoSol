@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity'])
    <!-- Edit Form -->
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('activities.update', $activity->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Activity Card -->
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <!-- Activity Image Section -->
                            <div class="col-auto">
                                <div class="avatar avatar-xl position-relative">
                                    <!-- Display accommodation image or a default image if not available -->
                                    <img
                                        src="{{ $activity->img ? asset('storage/' . $activity->img) : asset("/imgs/users/no-image.png") }}"
                                        alt="activity_image" class="border-radius-lg shadow-sm">
                                </div>
                            </div>
                            <!-- Activity Name Section -->
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        {{$activity->name}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    <x-general-errors />

                    <!-- Activity Information Card -->
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Edit Activity</p>

                                <!-- Action Buttons -->
                                <div>
                                    <!-- Update button -->
                                    <x-custom-button type="update" route={{null}}/>
                                    <!-- Cancel button -->
                                    <x-custom-button type="cancel" route="{{ route('activities.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="text-uppercase text-sm">Information</p>
                            <div class="row">
                                <!-- Activity Image Input -->
                                <div class="col-md-6">
                                    <label for="example-text-input"
                                           class="form-control-label">Image</label>
                                    <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                           accept="image/*" value="{{old('img', $activity->img)}}">
                                </div>

                                <!-- Activity Name Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror"
                                               type="text" name="name"
                                               value="{{old('name', $activity->name)}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Activity Type Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Type</label>
                                        <select
                                            class="form-control custom-dropdown @error('activity_type_id') is-invalid @enderror"
                                            name="activity_type_id" id="activity-select">
                                            @foreach($activity_types as $activity_type)
                                                <option value="{{$activity_type->id}}" {{ old('activity_type_id', $activity->activity_type_id) == $activity_type->id ? 'selected' : '' }}>
                                                    {{$activity_type->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('activity_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Activity Description Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Description</label>
                                        <textarea
                                            class="form-control auto-resize @error('description') is-invalid @enderror"
                                            name="description" rows="1"
                                            type="text" >{{old('description', $activity->description)}}</textarea>
                                        @error('description')
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
    @push('js')
        <script>
            document.addEventListener('input', function (event) {
                if (event.target.tagName === 'TEXTAREA' && event.target.classList.contains('auto-resize')) {
                    event.target.style.height = 'auto';
                    event.target.style.height = event.target.scrollHeight + 'px';
                }
            });
        </script>
    @endpush
@endsection

