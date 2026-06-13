@extends('errors.layout')

@section('icon')
    🚦
@endsection

@section('code')
    429
@endsection

@section('title')
    Too Many Requests
@endsection

@section('message')
    You're making requests too quickly. Please wait a moment before trying again.
@endsection

@section('footer')
    Too Many Requests
@endsection

@section('primary-button')

<a
    href="{{ route('dashboard') }}"
    class="btn btn-primary"
>
    🏠 Dashboard
</a>

@endsection