@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity'])
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{route('activities.store')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- Activity Card -->
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        New Activity
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
                                <p class="mb-0">Create Activity</p>

                                <!-- Action Buttons -->
                                <div>
                                    <!-- Create button -->
                                    <x-custom-button type="create" route={{null}}/>
                                    <!-- Cancel button -->
                                    <x-custom-button type="cancel" route="{{ route('activities.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Activity Information Section -->
                            <p class="text-uppercase text-sm">Information</p>
                            <div class="row">

                                <!-- Activity Image Upload -->
                                <div class="col-md-6">
                                    <label for="example-text-input"
                                           class="form-control-label">Image</label>
                                    <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                           accept="image/*" value="{{old('img')}}">
                                </div>

                                <!-- Activity Type Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Activity Type</label>
                                        <select
                                            class="form-control custom-dropdown @error('activity_type_id') is-invalid @enderror"
                                            name="activity_type_id" id="activity-select">
                                            @foreach($activity_types as $activity_type)
                                                <option value="{{$activity_type->id}}" {{ old('activity_type_id') == $activity_type->id ? 'selected' : '' }}>
                                                    {{$activity_type->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('activity_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Activity Name Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Activity Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror"
                                               type="text" name="name"
                                               value="{{old('name')}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Activity Description Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Activity Description</label>
                                        <textarea
                                            class="form-control auto-resize @error('description') is-invalid @enderror"
                                            name="description" rows="1">{{old('description')}}</textarea>
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

