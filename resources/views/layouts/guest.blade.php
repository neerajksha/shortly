<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Shortly') }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@vite([
    'resources/css/app.css',
    'resources/js/app.js'
])

<style>

    body{
        min-height:100vh;
        background:
            radial-gradient(circle at top left,#4f46e520,transparent 35%),
            radial-gradient(circle at top right,#7c3aed20,transparent 35%),
            #f8fafc;
    }

    .auth-wrapper{
        min-height:100vh;
    }

    

    .brand-side{
        background:
            linear-gradient(
                135deg,
                #4f46e5,
                #7c3aed
            );
        color:white;
    }

    .auth-card{
        border:none;
        border-radius:24px;
        box-shadow:0 20px 50px rgba(0,0,0,.08);
    }

    .form-control{
        border-radius:12px;
        padding:12px;
    }

    .btn-primary{
        background:#4f46e5;
        border:none;
        border-radius:12px;
    }

    .btn-primary:hover{
        background:#4338ca;
    }

</style>

</head>

<body>


{{ $slot }}


</body>

</html>
