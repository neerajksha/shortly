@extends('errors.layout')

@section('icon')
    💥
@endsection

@section('code')
    500
@endsection

@section('title')
    Internal Server Error
@endsection

@section('message')
    Something went wrong on our side. Our team has been notified and is working on a fix.
@endsection

@section('footer')
    Internal Server Error
@endsection

@section('primary-button')

<a
    href="{{ route('dashboard') }}"
    class="btn btn-primary"
>
    🏠 Dashboard
</a>

@endsection