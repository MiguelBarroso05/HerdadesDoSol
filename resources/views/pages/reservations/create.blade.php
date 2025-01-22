@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
<main class="hs-d-flex hs-flex-grow-1 hs-mt-8 hs-px-9 hs-justify-content-center">
  <livewire:create-reservation :user="auth()->user()"  />
</main>
@endsection
