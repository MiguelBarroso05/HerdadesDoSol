@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Products'])
    <x-custom-alert type="warning" :session="session('warning')"/>
    <x-custom-alert type="success" :session="session('success')"/>
    <x-custom-alert type="error" :session="session('error')"/>
    <div class="col-admin">
        <!-- Edit Form -->
        <div class="hs-container-fluid hs-py-4 hs-mt-8">
            <div class="hs-row hs-justify-content-center">
                <div class="hs-card hs-col-md-6">
                    <form method="POST" action="{{route('products.admin.update', $product)}}">
                        @csrf
                        @method('PUT')

                        <!-- Product Card -->
                        <div class="hs-card-body hs-p-3">
                            <div class=" hs-row hs-gx-4">
                                <!-- Product Type Image Section -->
                                <div class="hs-col-auto">
                                    <div class="hs-avatar hs-avatar-xl hs-position-relative">
                                        <!-- Display accommodation image or a default image if not available -->
                                        <img
                                            src="{{ $product->image ? asset('storage/'.$product->image) : asset('/imgs/users/no-image.png') }}"
                                            alt="profile_image" class="hs-border-radius-lg hs-shadow-sm">
                                    </div>
                                </div>
                                <!-- Product Name Section -->
                                <div class="hs-col-auto hs-my-auto">
                                    <div class="hs-h-100">
                                        <h5 class="hs-mb-1">
                                            {{$product->name}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Information Card -->
                        <div class="hs-card">
                            <div class="hs-card-header hs-pb-0">
                                <div class="hs-d-flex hs-align-items-center hs-justify-content-between">
                                    <p class="hs-mb-0">Edit Product</p>
                                    <!-- Cancel -->
                                    <x-custom-button type="cancelIcon" route="{{ route('products.admin.index') }}"/>
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
                                                   name="name" type="text" value="{{$product->name}}">
                                            @error('name')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="estate_id"
                                                   class="hs-form-control-label">Description</label>
                                            <textarea
                                                class="hs-form-control @error('estate_id') hs-is-invalid @enderror"
                                                name="description" type="text">{{$product->description}}</textarea>
                                            @error('description')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="estate_id" class="hs-form-control-label">Estate </label>
                                            <x-dropdown-input
                                                :optionText="'name'"
                                                :multiple="false"
                                                :placeholder="'Product estate'"
                                                :fixed="'bottom'"
                                                :name="'estate_id'"
                                                :object="\App\Models\Estate::all()"
                                                :user="null"
                                                :paramter="$product->estate_id"
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
                                                   class="hs-form-control-label">Category</label>
                                            <x-dropdown-input
                                                :optionText="'name'"
                                                :multiple="false"
                                                :placeholder="'Category'"
                                                :fixed="'bottom'"
                                                :name="'category_id'"
                                                :object="\App\Models\Category::all()"
                                                :user="null"
                                                :paramter="$product->category_id"
                                            />
                                            @error('category_id')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="hs-row">
                                    <!-- Product Size Input -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="example-text-input"
                                                   class="hs-form-control-label">Stock</label>
                                            <input class="hs-form-control @error('name') hs-is-invalid @enderror"
                                                   name="stock" type="number" value="{{$product->stock}}">

                                            @error('size')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="price" class="hs-form-control-label">Price</label>
                                            <input
                                                class="hs-form-control @error('price') hs-is-invalid @enderror"
                                                name="price"
                                                type="text" value="{{ old('price', $product->price) }}">
                                            @error('price')
                                            <div class="hs-invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="hs-col-md-6">
                                        <div class="hs-form-group">
                                            <label for="estate_id" class="hs-form-control-label">Image</label>
                                            <input class="hs-form-control @error('estate_id') hs-is-invalid @enderror"
                                                   name="image" type="file">
                                            @error('image')
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
