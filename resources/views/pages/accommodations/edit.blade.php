@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'accommodation'])
    <!-- Edit Form -->
    <div class="hs-container-fluid hs-py-4 hs-mt-8">
        <div class="hs-row hs-justify-content-center">
            <div class="hs-col-md-8">
                <form method="POST" action="{{route('accommodations.update', $accommodation->id)}}">
                    @csrf
                    @method('PUT')

                    <!-- accommodation Card -->
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-row hs-gx-4">
                            <!-- accommodation Type Image Section -->
                            <div class="hs-col-auto">
                                <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                    <!-- Display accommodation image or a default image if not available -->
                                    <img
                                        src="{{ $accommodation->accommodation_types->img ? asset('storage/'.$accommodation->accommodation_types->img) : asset('/imgs/users/no-image.png') }}"
                                        alt="profile_image" class="hs-border-radius-lg hs-shadow-sm">
                                </div>
                            </div>
                            <!-- accommodation Name Section -->
                            <div class="hs-col-auto hs-my-auto">
                                <div class="hs-h-100">
                                    <h5 class="hs-mb-1">
                                        Accommodation #{{$accommodation->id}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    <x-general-errors />

                    <!-- accommodation Information Card -->
                    <div class="hs-card">
                        <div class="hs-card-header hs-pb-0">
                            <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                <p class="hs-mb-0">Edit Accommodation</p>

                                <!-- Action Buttons -->
                                <div>
                                    <!-- Update -->
                                    <x-custom-button type="update" route={{null}}/>
                                    <!-- Cancel -->
                                    <x-custom-button type="cancel" route="{{ route('accommodations.index') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="hs-card-body">
                            <p class="hs-text-uppercase hs-text-sm">Information</p>
                            <div class="hs-row">

                                <!-- accommodation Type Input -->
                                <div class="hs-col-md-6">
                                    <div class="hs-form-group">
                                        <label for="example-text-input"
                                               class="hs-form-control-label">Type</label>
                                        <select
                                            class="hs-form-control hs-custom-dropdown @error('accommodation_type_id') is-invalid @enderror"
                                            name="accommodation_type_id" id="room-select">

                                            @foreach($accommodation_types as $accommodation_type)
                                                <option
                                                    value="{{ $accommodation_type->id }}"
                                                    {{ $accommodation->accommodation_type_id == $accommodation_type->id ? 'selected' : '' }}>
                                                    {{ $accommodation_type->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('accommodation_type_id')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- accommodation Size Input -->
                                <div class="hs-col-md-6">
                                    <div class="hs-form-group">
                                        <label for="example-text-input"
                                               class="hs-form-control-label">Size </label>
                                        <select class="hs-form-control hs-custom-dropdown @error('size') is-invalid @enderror"
                                                name="size" id="room-select">
                                            @foreach ([1, 2, 3, 4, 5, 6] as $size)

                                                <option
                                                    value="{{ $size }}"
                                                    {{ old('size', $accommodation->size) == $size ? 'selected' : '' }}>
                                                    {{ $size }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('size')
                                        <div class="hs-invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- accommodation Description Input -->
                                <div class="hs-col-md-12">
                                    <div class="hs-form-group">
                                        <label for="example-text-input"
                                               class="hs-form-control-label">Description</label>
                                        <textarea
                                            class="hs-form-control hs-auto-resize @error('description') is-invalid @enderror"
                                            name="description" rows="1">{{old('description', $accommodation->description)}}</textarea>
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
