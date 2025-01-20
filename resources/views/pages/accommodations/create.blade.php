@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'accommodation'])
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{route('accommodations.store')}}">
                    @csrf
                    <!-- accommodation Card -->
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <!-- accommodation Name Section -->
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        New Accommodation
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    <x-general-errors />

                    <!-- accommodation Information Card -->
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Create Accommodation</p>
                                <div>
                                    <!-- Create -->
                                    <x-custom-button type="create" route={{null}}/>
                                    <!-- Cancel -->
                                    <x-custom-button type="cancel" route="{{ route('accommodations.index') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- accommodation Information Section -->
                            <p class="text-uppercase text-sm">Information</p>
                            <div class="row">

                                <!-- accommodation Type Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Type</label>
                                        <select
                                            class="form-control custom-dropdown @error('accommodation_type_id') is-invalid @enderror"
                                            name="accommodation_type_id" id="room-select">
                                            @foreach($accommodation_types as $accommodation_type)
                                                <option value="{{$accommodation_type->id}}">
                                                    {{$accommodation_type->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('accommodation_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- accommodation Size Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Size</label>
                                        <select class="form-control custom-dropdown @error('size') is-invalid @enderror"
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
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- accommodation Description Input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Description</label>
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
