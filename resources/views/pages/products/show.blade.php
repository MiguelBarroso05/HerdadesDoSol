@extends('layouts.app')
@section('content')
    @include('layouts.navbars.guest.navbar')
    <livewire:ProductShow :product="$product"/>
@endsection
