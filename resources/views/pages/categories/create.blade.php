@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Categories'])
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-card hs-col-md-6">
                    <form method="POST" action="{{route('categories.store')}}">
                        @csrf
                        <!-- Product Information Card -->
                        <div class="hs-card">
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">New Category</p>
                                    <!-- Cancel -->
                                    <x-custom-button type="cancelIcon" route="{{ route('categories.index') }}"/>
                                </div>
                            </div>

                            <div class="hs-card-body">
                                <p class="hs-text-uppercase hs-text-sm">Information</p>
                                <div class="hs-row flex justify-between">
                                    <!-- Estate Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="estate_id" class="hs-form-control-label">Name</label>
                                            <input class="hs-form-control @error('estate_id') hs-is-invalid @enderror"
                                                   name="name" type="text">
                                            @error('name')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="hs-col-md-6">
                                    <x-custom-button type="create" route={{null}}/>
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
