@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodation Type'])

    <div class="col-admin">
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-col-md-8">
                    <form action="{{ route('accommodation_types.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Accommodation Type Card -->
                        <div class="hs-card-body hs-p-3">
                            <div class="hs-row hs-gx-4">
                                <div class="hs-col-auto hs-my-auto">
                                    <div class="hs-h-100">
                                        <h5 class="hs-mb-1">
                                            New Accommodation Type
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Messages -->
                        <x-general-errors />

                        <!-- Accommodation Type Information Card -->
                        <div class="hs-card">
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Create Accommodation Type</p>
                                    <!-- Action Buttons -->
                                    <div>
                                        <!-- Create button -->
                                        <x-custom-button type="create" route={{null}}/>
                                        <!-- Cancel button -->
                                        <x-custom-button type="cancel" route="{{ route('accommodation_types.index') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <!-- Accommodation Type Information Section -->
                                <p class="hs-text-uppercase hs-text-sm">Information</p>
                                <div class="hs-row">
                                    <!-- Accommodation Type Image Upload -->
                                    <div class="hs-col-md-6">
                                        <label class="hs-form-control-label">Image</label>
                                        <input type="file" class="hs-form-control" name="img" id="inputGroupFile02"
                                               accept="image/*">
                                    </div>

                                    <!-- Accommodation Type Name Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label class="hs-form-control-label">Name</label>
                                            <input class="hs-form-control @error('name') hs-is-invalid @enderror" type="text"
                                                   name="name" value="{{ old('name') }}">
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

