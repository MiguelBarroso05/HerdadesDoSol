@extends('errors.layout')

@section('title', 'No Access')
@section('error', '403')
@section('info', 'Oops! Page Out Of Your Reach')
@section('message', 'It looks like you are trying to access a page that you do not have access to. You’ll be redirected to the home page.')
@section('buttonRoute', route('home'))
@section('buttonText', 'Homepage')

@push('js')
    <script>
        <!-- Script to redirect to the homepage -->
        setTimeout(() => {
            window.location.href = "{{ route('home') }}";
        }, 3000);
    </script>
@endpush
