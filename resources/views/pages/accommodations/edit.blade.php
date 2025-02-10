@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodation'])
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-card hs-col-md-6">
                    <form method="POST" action="{{route('accommodations.update', $accommodation->id)}}">
                        @csrf
                        @method('PUT')

                        <!-- Accommodation Card -->
                        <div class="hs-card-body hs-p-3">
                            <div class=" hs-row hs-gx-4">
                                <!-- Accommodation Type Image Section -->
                                <div class="hs-col-auto">
                                    <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                        <!-- Display accommodation image or a default image if not available -->
                                        <img
                                            src="{{ $accommodation->accommodationType->img ? asset('storage/'.$accommodation->accommodationType->img) : asset('/imgs/users/no-image.png') }}"
                                            alt="profile_image" class="hs-border-radius-lg hs-shadow-sm">
                                    </div>
                                </div>
                                <!-- Accommodation Name Section -->
                                <div class="hs-col-auto hs-my-auto">
                                    <div class="hs-h-100">
                                        <h5 class="hs-mb-1">
                                            {{$accommodation->name}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accommodation Information Card -->
                        <div class="hs-card">
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Edit Accommodation</p>
                                    <!-- Cancel -->
                                    <x-custom-button type="cancelIcon" route="{{ route('accommodations.index') }}"/>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <p class="hs-text-uppercase hs-text-sm">Information</p>
                                <div class="hs-row flex justify-between">
                                    <!-- Estate Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="estate_id" class="hs-form-control-label">Estate </label>
                                            <x-dropdown-input
                                                :optionText="'name'"
                                                :multiple="false"
                                                :placeholder="'Accommodation estate'"
                                                :fixed="'bottom'"
                                                :name="'estate_id'"
                                                :object="\App\Models\Estate::all()"
                                                :user="null"
                                                :paramter="$accommodation->estate_id"
                                            />
                                            @error('estate_id')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Estate Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="accommodation_type_id"
                                                   class="hs-form-control-label">Accommodation Type </label>
                                            <x-dropdown-input
                                                :optionText="'name'"
                                                :multiple="false"
                                                :placeholder="'Accommodation Type'"
                                                :fixed="'bottom'"
                                                :name="'accommodation_type_id'"
                                                :object="\App\Models\accommodation\AccommodationType::all()"
                                                :user="null"
                                                :paramter="$accommodation->accommodation_type_id"
                                            />
                                            @error('accommodation_type_id')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="hs-row">
                                    <!-- Accommodation Size Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Size </label>
                                            <x-accommodation-size-select :accommodation="$accommodation"/>

                                            @error('size')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="price" class="hs-form-control-label">Price</label>
                                            <input class="hs-form-control @error('price') hs-is-invalid @enderror"
                                                   name="price"
                                                   type="text" value="{{ old('price', $accommodation->price) }}">
                                            @error('price')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="hs-col-md-6">
                                    <x-custom-button type="update" route={{null}}/>
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
