@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodation'])
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <div class="col-admin">
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-col-md-8">
                    <form method="POST" action="{{route('accommodations.store')}}">
                        @csrf
                        <!-- Accommodation Card -->
                        <div class="hs-card-body hs-p-3">
                            <div class="hs-row hs-gx-4">
                                <!-- Accommodation Name Section -->
                                <div class="hs-col-auto hs-my-auto">
                                    <div class="hs-h-100">
                                        <h5 class="hs-mb-1">
                                            New Accommodation
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Messages -->
                        <x-general-errors/>

                        <!-- Accommodation Information Card -->
                        <div class="hs-card">
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Create Accommodation</p>
                                    <div>
                                        <!-- Cancel -->
                                        <x-custom-button type="cancelIcon" route="{{ route('accommodations.index') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="hs-card-body">
                                <!-- Accommodation Information Section -->
                                <p class="hs-text-uppercase hs-text-sm">Information</p>
                                <div class="hs-row">
                                    <!-- Accommodation Type Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Type</label>
                                            <select
                                                class="hs-form-control hs-custom-dropdown @error('accommodation_type_id') is-invalid @enderror"
                                                name="accommodation_type_id" id="room-select">
                                                @foreach($accommodation_types as $accommodation_type)
                                                    <option value="{{$accommodation_type->id}}">
                                                        {{$accommodation_type->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('accommodation_type_id')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

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
                                                :paramter="null"
                                            />
                                            @error('estate_id')
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
                                                   class="hs-form-control-label">Size</label>
                                            <select
                                                class="hs-form-control hs-custom-dropdown @error('size') is-invalid @enderror"
                                                name="size" id="room-select">
                                                @foreach ([1, 2, 3, 4, 5, 6] as $size)
                                                    <option
                                                        value="{{ $size }}"
                                                        {{ old('size') == $size ? 'selected' : '' }}>
                                                        {{ $size }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                                   type="text" value="{{ old('price') }}">
                                            @error('price')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <!-- Accommodation Description Input -->
                                    <div class="hs-col-md-12">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Description</label>
                                            <textarea
                                                class="hs-form-control hs-auto-resize @error('description') is-invalid @enderror"
                                                name="description" rows="3">{{old('description')}}</textarea>
                                            @error('description')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Create -->
                                <x-custom-button type="create" route={{null}}/>
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
