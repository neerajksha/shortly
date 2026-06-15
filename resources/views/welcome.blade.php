<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Shortly is a modern URL shortener with QR codes, analytics, custom aliases and link expiration.">
    <meta name="keywords" content="URL shortener, QR code generator, link analytics, short links">
    <meta property="og:title" content="Shortly - Smart URL Shortener">
    <meta property="og:description" content="Create short links, track analytics and generate QR codes.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    
    <title>Shortly - Smart URL Shortener</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root{
        --primary:#4f46e5;
        --secondary:#7c3aed;
        --accent:#06b6d4;
        --dark:#0f172a;
        }

        body{
        background:#f8fafc;
        overflow-x:hidden;
        }

        .blob{
        position:fixed;
        border-radius:50%;
        filter:blur(120px);
        opacity:.15;
        z-index:-1;
        }

        .b1{width:500px;height:500px;background:#4f46e5;left:-150px;top:-150px;}
        .b2{width:400px;height:400px;background:#7c3aed;right:-100px;top:100px;}
        .b3{width:350px;height:350px;background:#06b6d4;bottom:-120px;left:40%;}

        .navbar{
        backdrop-filter:blur(20px);
        background:rgba(255,255,255,.8)!important;
        }

       .hero{
            min-height:100vh;
            display:flex;
            align-items:center;
        }

        .gradient-text{
        background:linear-gradient(135deg,var(--primary),var(--secondary));
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        }

        .glass-card,.card-modern{
        background:rgba(255,255,255,.85);
        backdrop-filter:blur(16px);
        border:none;
        border-radius:28px;
        box-shadow:0 20px 50px rgba(0,0,0,.08);
        }

        .card-modern{
        padding:30px;
        transition:.3s;
        }   

        .card-modern:hover{
        transform:translateY(-8px);
        }

        .floating{
        animation:float 5s ease-in-out infinite;
        }

        @keyframes float{
        50%{transform:translateY(-12px)}
        }

        .feature-icon{
        font-size:2.5rem;
        }

        .stats-card{
        background:linear-gradient(135deg,var(--primary),var(--secondary));
        color:white;
        border-radius:30px;
        padding:50px;
        }

        .cta{
        background:#111827;
        color:white;
        border-radius:32px;
        padding:70px 40px;
        }

        footer{
        background:#fff;
        padding:60px 0;
        }
    </style>
</head>

<body>

    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3">🔗 Shortly</a>

        <div>

        <a
            href="{{ route('developers') }}"
            class="btn btn-info"
        >
            Developers
        </a>
        @guest
            <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Start Free</a>
        @else
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
            @endif
        @endguest
        </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6" data-aos="fade-right">
                    <span class="badge bg-light text-dark mb-3">🚀 Modern Link Management Platform</span>

                    <h1 class="display-1 fw-bold">
                    Shorten.<br>
                    <span class="gradient-text">Track.</span><br>
                    Scale.
                    </h1>

                    <p class="lead text-secondary">
                    Create branded links, QR codes and advanced analytics dashboards.
                    </p>

                <div class="mt-4">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
                    Get Started
                    </a>

                    <a href="#features" class="btn btn-outline-dark btn-lg">
                    Explore Features
                    </a>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="glass-card p-4 floating">

                    <h5 class="fw-bold">
                        Start Shortening Links
                    </h5>

                    @auth

                    <form
                        method="POST"
                        action="{{ route('urls.store') }}"
                    >

                        @csrf

                        <input
                            type="url"
                            name="url"
                            class="form-control my-3"
                            placeholder="https://example.com"
                            required
                        >

                        <button
                            class="btn btn-primary w-100"
                        >
                            Shorten URL
                        </button>

                    </form>

                    @else

                    <div class="alert alert-info">

                        Create a free account to start shortening URLs.

                    </div>

                    <a
                        href="{{ route('register') }}"
                        class="btn btn-primary w-100"
                    >
                        Create Free Account
                    </a>

                    @endauth

                </div>
            </div>

        </div>
        </div>
    </section>

    <section class="py-5 text-center">
        <div class="container">
            <p class="text-muted fw-bold">TRUSTED BY MODERN TEAMS</p>

            <div class="row">
                <div class="col">STARTUPS</div>
                <div class="col">CREATORS</div>
                <div class="col">AGENCIES</div>
                <div class="col">SAAS</div>
                <div class="col">ENTERPRISES</div>
            </div>
        </div>
    </section>

    <section id="features" class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Everything You Need</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card-modern">
                    <div class="feature-icon">🔗</div>
                    <h4>Branded Links</h4>
                    <p>Create memorable custom short URLs.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-modern">
                    <div class="feature-icon">📊</div>
                    <h4>Analytics</h4>
                    <p>Track clicks, devices and browsers.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-modern">
                    <div class="feature-icon">📱</div>
                    <h4>QR Codes</h4>
                    <p>Generate QR codes instantly.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-modern">
                    <div class="feature-icon">🌍</div>
                    <h4>Geo Tracking</h4>
                    <p>Know where visitors come from.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-modern">
                    <div class="feature-icon">⏰</div>
                    <h4>Link Expiry</h4>
                    <p>Set automatic expiration dates.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-modern">
                    <div class="feature-icon">👨‍💼</div>
                    <h4>Admin Panel</h4>
                    <p>Manage users, URLs & analytics.</p>
                </div>
            </div>

        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4">

            <div class="col-lg-8">
                <div class="card-modern">
                    <h3 class="fw-bold mb-4">Analytics Dashboard</h3>
                    <img
                        src="{{ asset('images/dashboard-preview.png') }}"
                        class="img-fluid rounded shadow"
                        alt="Shortly Analytics Dashboard"
                    >
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-modern mb-4">
                    <h2>{{ number_format($clicksCount) }}</h2>
                    <p>Total Clicks</p>
                </div>

                <div class="card-modern mb-4">
                    <h2>{{ number_format($urlsCount) }}</h2>
                    <p>Active URLs</p>
                </div>

                <div class="card-modern">
                    <h2>{{ number_format($usersCount) }}</h2>
                    <p>Registered Users</p>
                </div>
            </div>

        </div>
    </section>


    <section class="container py-5">
        <div class="cta text-center">
            <h2 class="display-5 fw-bold">Ready to simplify your links?</h2>
            <p class="mb-4">Join thousands of users already using Shortly.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">Create Free Account</a>
        </div>
    </section>

    <footer class="bg-white border-top mt-5">

        <div class="container py-5">

            <div class="row g-4">

                <!-- Brand -->

                <div class="col-lg-4">

                    <h3 class="fw-bold text-primary mb-3">
                        🔗 Shortly
                    </h3>

                    <p class="text-muted">
                        A modern URL shortening platform with powerful analytics,
                        QR codes, custom aliases, and link management tools.
                    </p>

                    <div class="d-flex gap-3 fs-5">

                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-github"></i>
                        </a>

                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-linkedin"></i>
                        </a>

                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                    </div>

                </div>

                <!-- Product -->

                <div class="col-md-2">

                    <h6 class="fw-bold mb-3">
                        Product
                    </h6>

                    <ul class="list-unstyled">

                        <li class="mb-2">
                            <a href="#features" class="text-muted text-decoration-none">
                                Features
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="#" class="text-muted text-decoration-none">
                                Analytics
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="#" class="text-muted text-decoration-none">
                                QR Codes
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-muted text-decoration-none">
                                API
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- Resources -->

                <div class="col-md-2">

                    <h6 class="fw-bold mb-3">
                        Resources
                    </h6>

                    <ul class="list-unstyled">

                        <li class="mb-2">
                            <a href="#" class="text-muted text-decoration-none">
                                Documentation
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="#" class="text-muted text-decoration-none">
                                Help Center
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-muted text-decoration-none">
                                Blog
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- Contact -->

                <div class="col-md-4">

                    <h6 class="fw-bold mb-3">
                        Contact
                    </h6>

                    <p class="text-muted mb-2">
                        support@shortly.com
                    </p>

                    <p class="text-muted">
                        Built with Laravel & Bootstrap
                    </p>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">

                <p class="text-muted mb-0">
                    © {{ date('Y') }} Shortly. All rights reserved.
                </p>

                <div class="d-flex gap-3">

                    <a href="#" class="text-muted text-decoration-none">
                        Privacy Policy
                    </a>

                    <a href="#" class="text-muted text-decoration-none">
                        Terms of Service
                    </a>

                </div>

            </div>

        </div>

    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init({
            once: true
        });
    </script>
</body>
</html>
