@extends('errors.layout')

@section('icon','🔐')
@section('code','401')
@section('title','Authentication Required')
@section('message','Please login to continue.')

@section('footer','Unauthorized')

@section('primary-button')

<a
    href="{{ route('login') }}"
    class="btn btn-primary"
>
    🔑 Login
</a>

@endsection