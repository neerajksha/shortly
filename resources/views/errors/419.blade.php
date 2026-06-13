@extends('errors.layout')

@section('icon','⏰')
@section('code','419')
@section('title','Session Expired')
@section('message','Your session has expired. Please refresh the page.')

@section('footer','Page Expired')

@section('primary-button')

<button
    onclick="location.reload()"
    class="btn btn-primary"
>
    🔄 Refresh
</button>

@endsection