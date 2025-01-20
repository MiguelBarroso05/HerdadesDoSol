@extends('errors.layout')

@section('title', 'Something Went Wrong')
@section('error', 'error')
@section('info', 'Oops! Something went wrong')
@section('message', 'It looks like something happened that we can’t resolve. Try heading back to the homepage.')
@section('buttonRoute', route('home'))
@section('buttonText', 'Homepage')
