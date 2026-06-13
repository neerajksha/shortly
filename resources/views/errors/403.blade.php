@extends('errors.layout')

@section('icon')
    🔒
@endsection

@section('code')
    403
@endsection

@section('title')
    Access Denied
@endsection

@section('message')
    You don't have permission to access this resource.
@endsection

@section('footer')
    Forbidden
@endsection

@section('primary-button')

<a
    href="{{ route('dashboard') }}"
    class="btn btn-primary"
>
    🏠 Dashboard
</a>

@endsection