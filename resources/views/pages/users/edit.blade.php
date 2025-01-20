@extends('layouts.app')
@section('content')
<div>


<x-select
    label="Search a User"
    placeholder="Select some user"
    :async-data="$user"
    option-label="name"
    option-value="id"
/>
</div>
@endsection
