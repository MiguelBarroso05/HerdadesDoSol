@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
<main class="hs-d-flex hs-flex-grow-1 hs-mt-8 hs-px-9 hs-justify-content-center hs-mb-2">
  <livewire:create-reservation :user="auth()->user()" lazy />
    <x-dropdown-input
        :optionText="'name'"
        :multiple="false"
        :placeholder="'Add your fav estate...'"
        :fixed="'top'"
        :name="'fav_estate'"
        :object="null"
        :user="auth()->user()"
        :paramter="null"
        :optionText="'name'"
    />
</main>
@endsection
