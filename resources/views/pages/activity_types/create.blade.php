@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activity Type'])
    <div class="hs-container-fluid hs-py-4 hs-mt-8">
        <div class="hs-row hs-justify-content-center">
            <div class="hs-col-md-8">
                <form method="POST" action="{{route('activity_types.store')}}"
                      enctype="multipart/form-data">
                    @csrf

                    <!-- Activity Type Card -->
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-row hs-gx-4">
                            <!-- Activity Type Name Section -->
                            <div class="hs-col-auto hs-my-auto">
                                <div class="hs-h-100">
                                    <h5 class="hs-mb-1">
                                        New Activity Type
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
                                <p class="hs-mb-0">Create Activity Type</p>
                                <!-- Action Buttons -->
                                <div>
                                    <!-- Create button -->
                                    <x-custom-button type="create" route={{null}}/>
                                    <!-- Cancel button -->
                                    <x-custom-button type="cancel" route="{{ route('activity_types.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="hs-card-body">
                            <!-- Activity Type Information Section -->
                            <p class="hs-text-uppercase hs-text-sm">Information</p>
                            <div class="hs-row hs-d-flex hs-flex-row">

                                <!-- Activity Name Input -->
                                <div class="hs-col-md-6">
                                    <div class="hs-form-group">
                                        <label for="example-text-input"
                                               class="hs-form-control-label">Name</label>
                                        <input class="hs-mt-3 hs-form-control @error('name') hs-is-invalid @enderror"
                                               type="text" name="name">
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
@endsection
