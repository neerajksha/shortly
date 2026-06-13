<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/jquery.dataTables.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js"></script>
       
<style>
body{
    background:#f4f7fb;
}

.hero-section{
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    color:#fff;
    border-radius:20px;
    padding:30px;
    margin-bottom:25px;
    box-shadow:0 15px 35px rgba(79,70,229,.25);
}

.stat-card{
    border:none;
    border-radius:16px;
    color:#fff;
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-primary{
    background:linear-gradient(135deg,#4f46e5,#6366f1);
}

.stat-success{
    background:linear-gradient(135deg,#10b981,#34d399);
}

.stat-warning{
    background:linear-gradient(135deg,#f59e0b,#fbbf24);
}

.stat-danger{
    background:linear-gradient(135deg,#ef4444,#f87171);
}

.shortener-card,
.table-card{
    border:none;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

.form-control{
    border-radius:12px;
}

.btn-shorten{
    background:#4f46e5;
    color:white;
    border:none;
    border-radius:12px;
}

.btn-shorten:hover{
    background:#4338ca;
    color:white;
}

.card-header{
    background:white;
    border-bottom:1px solid #eee;
    font-weight:600;
}

.table thead th{
    background:#f8fafc;
}

.stats-icon{
    font-size:2rem;
}



.analytics-hero{
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    color:white;
    border-radius:20px;
    padding:30px;
    margin-bottom:25px;
    box-shadow:0 15px 35px rgba(79,70,229,.25);
}

.analytics-card{
    border:none;
    border-radius:16px;
    color:white;
    transition:.3s;
}

.analytics-card:hover{
    transform:translateY(-5px);
}

.card-clicks{
    background:linear-gradient(135deg,#4f46e5,#6366f1);
}

.card-visitors{
    background:linear-gradient(135deg,#10b981,#34d399);
}

.card-shortcode{
    background:linear-gradient(135deg,#06b6d4,#38bdf8);
}

.analytics-table{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

.analytics-table .card-header{
    background:white;
    border-bottom:1px solid #eee;
    font-weight:600;
}

.short-url-box{
    background:rgba(255,255,255,.15);
    padding:12px;
    border-radius:12px;
    margin-top:15px;
}

.copy-url{
    background:white;
    color:#4f46e5;
    border:none;
}

.copy-url:hover{
    background:#eef2ff;
}

.status-badge{
    font-size:14px;
    padding:8px 12px;
}


.navbar-custom{
    background: linear-gradient(135deg,#4f46e5,#7c3aed);
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
}

.navbar-custom .nav-link,
.navbar-custom .navbar-brand{
    color:white !important;
}

.navbar-custom .nav-link:hover{
    opacity:.85;
}

.logo-circle{
    width:42px;
    height:42px;
    border-radius:12px;
    background:rgba(255,255,255,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:20px;
    font-weight:700;
}

.user-menu{
    background:rgba(255,255,255,.15);
    color:white;
    border:none;
    border-radius:12px;
    padding:8px 14px;
}

.user-menu:hover{
    background:rgba(255,255,255,.25);
}


.form-control{
    border-radius:12px;
    padding:12px;
}

.btn-primary{
    background:#4f46e5;
    border:none;
    border-radius:12px;
    padding:10px 20px;
}

.btn-primary:hover{
    background:#4338ca;
}


.btn-danger{
    border-radius:12px;
    padding:10px 20px;
}

.modal-content{
    border:none;
    border-radius:18px;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
}


</style>


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
