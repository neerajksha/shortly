@extends('errors.layout')

@section('icon')
    🛠️
@endsection

@section('code')
    503
@endsection

@section('title')
    Service Unavailable
@endsection

@section('message')
    We're currently performing scheduled maintenance. Please check back again shortly.
@endsection

@section('footer')
    Service Unavailable
@endsection

@section('primary-button')

<a
    href="{{ url('/') }}"
    class="btn btn-primary"
>
    🏡 Home
</a>

@endsection