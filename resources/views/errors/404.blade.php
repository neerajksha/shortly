@extends('errors.layout')

@section('icon')
    🔍
@endsection

@section('code')
    404
@endsection

@section('title')
    Page Not Found
@endsection

@section('message')
    The page you are looking for doesn't exist or may have been moved.
@endsection

@section('footer')
    Not Found
@endsection

@section('primary-button')

<a
    href="{{ route('dashboard') }}"
    class="btn btn-primary"
>
    🏠 Dashboard
</a>

@endsection