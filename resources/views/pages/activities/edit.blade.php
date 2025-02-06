@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-col-md-8">
                    <form action="{{route('activities.update', $activity->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Activity Card -->
                        <div class="hs-card-body hs-p-3">
                            <div class="hs-row hs-gx-4">
                                <!-- Activity Image Section -->
                                <div class="hs-col-auto">
                                    <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                        <!-- Display accommodation image or a default image if not available -->
                                        <img
                                            src="{{ $activity->img ? asset('storage/' . $activity->img) : asset('/imgs/users/no-image.png') }}"
                                            alt="activity_image" class="hs-border-radius-lg hs-shadow-sm">
                                    </div>
                                </div>
                                <!-- Activity Name Section -->
                                <div class="hs-col-auto hs-my-auto">
                                    <div class="hs-h-100">
                                        <h5 class="hs-mb-1">
                                            {{$activity->name}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Messages -->
                        <x-general-errors />

                        <!-- Activity Information Card -->
                        <div class="hs-card">
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Edit Activity</p>

                                    <!-- Action Buttons -->
                                    <div>
                                        <!-- Update button -->
                                        <x-custom-button type="update" route={{null}}/>
                                        <!-- Cancel button -->
                                        <x-custom-button type="cancel" route="{{ route('activities.index') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <p class="hs-text-uppercase hs-text-sm">Information</p>
                                <div class="hs-row">
                                    <!-- Activity Image Input -->
                                    <div class="hs-col-md-6">
                                        <label for="example-text-input"
                                               class="hs-form-control-label">Image</label>
                                        <input type="file" class="hs-form-control" name="img" id="inputGroupFile02"
                                               accept="image/*" value="{{old('img', $activity->img)}}">
                                    </div>

                                    <!-- Activity Name Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Name</label>
                                            <input class="hs-form-control @error('name') hs-is-invalid @enderror"
                                                   type="text" name="name"
                                                   value="{{old('name', $activity->name)}}">
                                            @error('name')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="hs-row">

                                    <!-- Activity Type Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Type</label>
                                            <select
                                                class="hs-form-control hs-custom-dropdown @error('activity_type_id') hs-is-invalid @enderror"
                                                name="activity_type_id" id="activity-select">
                                                @foreach($activity_types as $activity_type)
                                                    <option value="{{$activity_type->id}}" {{ old('activity_type_id', $activity->activity_type_id) == $activity_type->id ? 'selected' : '' }}>
                                                        {{$activity_type->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('activity_type_id')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Activity Description Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">Description</label>
                                            <textarea
                                                class="hs-form-control hs-auto-resize @error('description') hs-is-invalid @enderror"
                                                name="description" rows="1"
                                                type="text" >{{old('description', $activity->description)}}</textarea>
                                            @error('description')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
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
    </div>

    @push('js')
        <script>
            document.addEventListener('input', function (event) {
                if (event.target.tagName === 'TEXTAREA' && event.target.classList.contains('hs-auto-resize')) {
                    event.target.style.height = 'auto';
                    event.target.style.height = event.target.scrollHeight + 'px';
                }
            });
        </script>
    @endpush
@endsection
