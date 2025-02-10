@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity Type'])
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <div class="col-admin">
        <div class="hs-container-fluid ">
            <div class="hs-row place-content-center">
                <div class="hs-col-md-5">
                    <!-- Activity Type Edit Form -->
                    <div class="hs-card">
                        <form role="form" method="POST"
                              action={{ route('activity_types.update', $activity_type) }} enctype="multipart/form-data">
                            @csrf <!-- CSRF token for security -->
                            @method('PUT')
                            <!-- Form Header -->
                            <div class="hs-card-header hs-pb-0 rounded-2xl">
                                <div class="hs-d-flex hs-align-items-center justify-between">
                                    <p class="hs-mb-0">Edit Activity Type</p>
                                    <x-custom-button type="cancelIcon" route="{{route('activity_types.index')}}"/>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- Activity Type Information Section -->
                                <div class="hs-row">
                                    <!-- Name input -->
                                    <div class="hs-col-md-5">
                                        <div class="hs-form-group">
                                            <label for="example-text-input" class="hs-form-control-label">Activity Type
                                                Name</label>
                                            <input class="hs-form-control @error('name') hs-is-invalid @enderror" type="text" name="name"
                                                   value="{{ old('name', $activity_type->name) }}">
                                            @error('name')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <x-custom-button type="update" route="{{null}}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
