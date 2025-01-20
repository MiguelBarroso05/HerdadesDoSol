@extends('errors.layout')

@section('title', 'Page Not Found')
@section('error', '404')
@section('info', 'Oops! Page Not Found')
@section('message', 'It looks like nothing was found at this location. Try heading back to the homepage.')
@section('buttonRoute', route('home'))
@section('buttonText', 'Homepage')
