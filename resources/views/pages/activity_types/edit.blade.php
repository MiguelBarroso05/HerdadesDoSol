@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity Type'])

    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-col-md-8">
                    <form method="POST" action="{{route('activity_types.update', $activity_type->id)}}">
                        @csrf
                        @method('PUT')

                        <!-- Activity Type Card -->
                        <div class="hs-card-body hs-p-3">
                            <div class="hs-row hs-gx-4">
                                <!-- accommodation Type Name Section -->
                                <div class="hs-col-auto hs-my-auto">
                                    <div class="hs-h-100">
                                        <h5 class="hs-mb-1">
                                            {{$activity_type->name}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Messages -->
                        <x-general-errors />

                        <!-- Activity Type Information Card -->
                        <div class="hs-card">
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Edit Activity Type</p>

                                    <!-- Action Buttons -->
                                    <div>
                                        <!-- Update button -->
                                        <x-custom-button type="update" route={{null}}/>
                                        <!-- Cancel button -->
                                        <x-custom-button type="cancel" route="{{ route('activity_types.index') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- Activity Information Section -->
                                <p class="hs-text-uppercase hs-text-sm">Information</p>
                                <div class="hs-row">
                                    <!-- Activity Type Name Upload -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Name</label>
                                            <input class="hs-form-control @error('name') hs-is-invalid @enderror"
                                                   type="text" name="name"
                                                   value="{{old('name', $activity_type->name)}}">
                                            @error('name')
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
@endsection
