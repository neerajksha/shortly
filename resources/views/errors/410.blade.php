@extends('errors.layout')

@section('icon','🗑️')
@section('code','410')
@section('title','Page Gone')
@section('message','The page you are looking for has been permanently removed and is no longer available.')

@section('footer','Gone')

@section('primary-button')

<a
    href="{{ url('/') }}"
    class="btn btn-primary">
    🏠 Go Home
</a>

@endsection