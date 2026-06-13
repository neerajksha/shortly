<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('code') - @yield('title')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body{
            min-height:100vh;
            overflow:hidden;
            background:#f8fafc;
            position:relative;
        }

        .blob{
            position:absolute;
            border-radius:50%;
            filter:blur(100px);
            opacity:.18;
        }

        .blob-1{
            width:400px;
            height:400px;
            background:#4f46e5;
            top:-100px;
            left:-100px;
        }

        .blob-2{
            width:300px;
            height:300px;
            background:#7c3aed;
            right:-80px;
            top:120px;
        }

        .blob-3{
            width:250px;
            height:250px;
            background:#06b6d4;
            bottom:-80px;
            left:40%;
        }

        .error-card{
            backdrop-filter:blur(15px);
            background:rgba(255,255,255,.85);
            border:none;
            border-radius:32px;
            box-shadow:0 20px 60px rgba(0,0,0,.08);
        }

        .error-code{
            font-size:8rem;
            font-weight:900;
            line-height:1;
            background:linear-gradient(
                135deg,
                #4f46e5,
                #7c3aed
            );
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .btn-primary{
            background:#4f46e5;
            border:none;
            border-radius:12px;
            padding:12px 24px;
        }

        .btn-primary:hover{
            background:#4338ca;
        }

    </style>

</head>

<body>

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="container">

        <div
            class="d-flex justify-content-center align-items-center"
            style="min-height:100vh;"
        >

            <div
                class="card error-card p-5 text-center"
                style="
                    max-width:650px;
                    width:100%;
                "
            >

                <div class="mb-3 fs-1">
                    @yield('icon')
                </div>

                <h1 class="error-code">
                    @yield('code')
                </h1>

                <h2 class="fw-bold mt-3">
                    @yield('title')
                </h2>

                <p class="text-muted mt-3 mb-4">
                    @yield('message')
                </p>

                <div class="d-flex justify-content-center gap-3">

                    @yield('primary-button')

                    <button
                        onclick="history.back()"
                        class="btn btn-outline-secondary"
                    >
                        ← Go Back
                    </button>

                </div>

                <hr class="my-4">

                <small class="text-muted">

                    Error Code:
                    @yield('code')
                    @yield('footer')

                </small>

            </div>

        </div>

    </div>

</body>

</html>