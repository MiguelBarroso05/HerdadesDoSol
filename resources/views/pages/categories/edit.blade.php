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
                    <form method="POST" action="{{route('products.admin.update', $category)}}">
                        @csrf
                        @method('PUT')

                        <!-- Product Card -->
                        <div class="hs-card-body hs-p-3">
                            <div class=" hs-row hs-gx-4">
                                <!-- Product Type Image Section -->

                                <!-- Product Name Section -->
                                <div class="hs-col-auto hs-my-auto">
                                    <div class="hs-h-100">
                                        <h5 class="hs-mb-1">
                                            {{$category->name}}
                                        </h5>
                                    </div>
                                </div>
                            </div>


                            <div class="hs-col-md-6">
                                <x-custom-button type="update" route={{null}}/>
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
