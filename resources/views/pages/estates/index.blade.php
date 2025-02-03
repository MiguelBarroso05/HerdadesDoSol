@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'All estates'])
    <x-custom-alert type="warning" :session="session('warning_estates')" />
    <x-custom-alert type="success" :session="session('success')" />
    <div class="col-admin">
        <div class="hs-container-fluid hs-py-4">
            <div class="hs-row">
                <div class="hs-col-12">
                    <!-- Card container for the Users table -->
                    <div class="hs-card hs-mb-4">
                        <div class="hs-card-header hs-pb-0 hs-d-flex hs-justify-content-between">
                            <div>
                                <h6>Estates table</h6>
                            </div>
                            <!-- Search Bar -->
                            <div>
                                <x-search-bar searchbarName="search_estates"/>
                            </div>
                            <div>
                                <!-- Button Create New -->
                                <x-custom-button type="createNew" route="{{ route('estates.create') }}"/>
                            </div>
                        </div>

                        <div class="hs-card-body hs-px-0 hs-pt-0 hs-pb-2">
                            <!-- Table wrapper with responsive design -->
                            <div class="hs-table-responsive hs-p-0">
                                <table class="hs-table hs-align-items-center hs-mb-0">
                                    <!-- Table header -->
                                    <thead>
                                    <tr>
                                        <!-- Table column headers -->
                                        <th class="hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Name
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Location
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Status
                                        </th>
                                        <th class="hs-text-center hs-text-uppercase hs-text-secondary hs-text-xxs hs-font-weight-bolder hs-opacity-7">
                                            Activated/Disabled at
                                        </th>
                                        <th class="hs-text-secondary hs-opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Loop through the $estates collection to display each estate -->
                                    @foreach($estates as $estate)
                                        <tr>
                                            <!-- Estate column -->
                                            <td>
                                                <div class="hs-d-flex hs-px-2 hs-py-1">
                                                    <!-- Estate image -->
                                                    <div>
                                                        <img
                                                            src="{{ $estate->img ? asset('storage/'.$estate->img) : asset('/imgs/users/no-image.png') }}"
                                                            class="hs-avatar hs-avatar-sm hs-me-3" alt="User image">
                                                    </div>
                                                    <!-- Username and email -->
                                                    <div class="hs-d-flex hs-flex-column hs-justify-content-center">
                                                        <h6 class="hs-mb-0 hs-text-sm">{{ $estate->name }} </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="hs-d-flex hs-px-2 hs-py-1 place-self-center">
                                                    <div class="hs-d-flex hs-flex-column hs-justify-content-center">
                                                        <h6 class="hs-mb-0 hs-text-sm">{{ $estate->address->city }}</h6>
                                                        <p class="hs-mb-0 hs-text-sm">{{ $estate->address->street }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Estate status column -->
                                            <td class="hs-align-middle hs-text-center hs-text-sm">
                                                <!-- Status badge: Active or Inactive -->
                                                <span
                                                    class="hs-badge hs-badge-sm {{ is_null($estate->deleted_at) ? 'hs-bg-gradient-success' : 'hs-bg-gradient-danger' }}">
                                                    {{ is_null($estate->deleted_at) ? 'Active' : 'In Maintenance' }}
                                                </span>
                                            </td>

                                            <!-- Estate activation/disable date -->
                                            <td class="hs-align-middle hs-text-center">
                                                <span class="hs-text-secondary hs-text-xs hs-font-weight-bold">
                                                    @if (is_null($estate->deleted_at))
                                                        {{ $estate->created_at ? $estate->created_at->format('d/m/Y') : 'No date available' }}
                                                    @else
                                                        {{ $estate->deleted_at ? $estate->deleted_at->format('d/m/Y') : 'No date available' }}
                                                    @endif
                                                </span>
                                            </td>

                                            <!-- Action buttons -->
                                            <td class="hs-align-middle hs-d-flex hs-justify-content-evenly items-center min-h-[67px]">
                                                <!-- Show User button -->
                                                <x-custom-button type="show" route="{{ route('estates.show', $estate->id) }}"/>

                                                <!-- Edit User button -->
                                                <x-custom-button type="edit" route="{{ route('estates.edit', $estate) }}"/>

                                                <!-- Conditional: Disable or Activate User -->
                                                @if(is_null($estate->deleted_at))
                                                    <!-- Disable user -->
                                                    <x-custom-button type="disableEstate" route="{{route('estates.destroy', ['estate' => $estate])}}"/>
                                                @else
                                                    <!-- Activate user -->
                                                    <x-custom-button type="enableEstate" route="{{ route('estates.recover', ['estate' => $estate]) }}"/>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="hs-d-flex hs-justify-content-center hs-mt-4">
                                    {{ $estates->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
