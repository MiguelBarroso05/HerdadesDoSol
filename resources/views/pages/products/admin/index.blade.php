
@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Products'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="col-admin">
        <div class="hs-container-fluid">
            <div class="hs-row">
                <div class="hs-col-12">
                    <!-- Accommodations Table -->
                    <div class="hs-card hs-mb-4">
                        <div class="hs-card-header hs-pb-0 hs-d-flex hs-justify-content-between">
                            <h6>Products Table</h6>

                            <!-- Search Bar -->
                            <x-search-bar :searchbarName="'search_products'" />

                            <!-- Create New button -->
                            <a href="{{ route('products.admin.create') }}"
                               class="hs-mx-2"
                               data-toggle="tooltip">
                                <i class="bi bi-plus-circle hs-fs-3"></i>
                            </a>
                        </div>
                        <div class="hs-card-body hs-px-0 hs-pt-0 hs-pb-2">
                            <div class="hs-table-responsive hs-p-0">
                                <table class="hs-table hs-align-items-center hs-mb-0">
                                    <!-- Table Head -->
                                    <thead>
                                    <tr>
                                        <th class="hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Product
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Category
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Price
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Last Update
                                        </th>
                                        <th class="hs-text-secondary hs-opacity-7"></th>
                                    </tr>
                                    </thead>

                                    <!-- Table Body -->
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <div class="hs-d-flex hs-px-2 hs-py-1">
                                                    <!-- Image -->
                                                    <div>
                                                        <img
                                                            src="{{$product->image ? asset('storage/'.$product->image) : asset('/imgs/users/no-image.png') }}"
                                                            class="hs-avatar hs-avatar-sm hs-me-3" alt="User image">
                                                    </div>
                                                    <!-- Id -->
                                                    <div class="hs-d-flex hs-flex-column hs-justify-content-center">
                                                        <h6 class="hs-mb-0 hs-text-sm">{{ $product->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Type Name -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{$product->category->name}}</span>
                                            </td>
                                            <!-- Size -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{$product->price}}€</span>
                                            </td>
                                            <!-- Updated At -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span
                                                    class="hs-text-secondary hs-text-xs hs-font-weight-bold">{{$product->updated_at}}</span>
                                            </td>

                                            <!-- Action Buttons -->
                                            <td class="hs-align-middle hs-d-flex hs-justify-content-evenly items-center min-h-[61px]">
                                                <!-- Show button -->
                                                <x-custom-button type="show" route="{{ route('products.admin.show', $product) }}"/>

                                                <!-- Edit button -->
                                                <x-custom-button type="edit" route="{{ route('products.admin.edit',$product) }}"/>

                                                <!-- Delete button -->
                                                <x-custom-button type="delete" route="{{ route('products.admin.destroy', ['product' => $product]) }}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="hs-d-flex hs-justify-content-center hs-mt-4">
                                    {{ $products->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
