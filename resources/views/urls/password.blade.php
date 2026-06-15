<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Protected Link
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body{
            min-height:100vh;
            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #7c3aed
                );
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
            overflow-x:hidden;
            position:relative;
            font-family:Inter,sans-serif;
        }

        .blob{
            position:absolute;
            border-radius:50%;
            filter:blur(100px);
            opacity:.18;
        }

        .blob-1{
            width:350px;
            height:350px;
            background:white;
            top:-120px;
            left:-120px;
        }

        .blob-2{
            width:300px;
            height:300px;
            background:#06b6d4;
            bottom:-80px;
            right:-80px;
        }

        .auth-card{
            width:100%;
            max-width:500px;
            border:none;
            border-radius:28px;
            overflow:hidden;
            backdrop-filter:blur(20px);
            background:rgba(255,255,255,.96);
            box-shadow:
                0 25px 60px rgba(0,0,0,.15);
            position:relative;
            z-index:10;
        }

        .icon-box{
            width:90px;
            height:90px;
            border-radius:24px;
            margin:auto;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:42px;
            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #7c3aed
                );
            color:white;
            box-shadow:
                0 10px 25px rgba(79,70,229,.3);
        }

        .secure-badge{
            display:inline-block;
            background:#eef2ff;
            color:#4f46e5;
            padding:8px 14px;
            border-radius:999px;
            font-size:13px;
            font-weight:600;
        }

        .form-control{
            height:56px;
            border-radius:14px;
            border:1px solid #dbeafe;
            padding:0 18px;
        }

        .form-control:focus{
            border-color:#4f46e5;
            box-shadow:
                0 0 0 .2rem rgba(79,70,229,.15);
        }

        .btn-unlock{
            height:56px;
            border:none;
            border-radius:14px;
            font-weight:600;
            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #7c3aed
                );
            transition:.3s;
        }

        .btn-unlock:hover{
            transform:translateY(-2px);
            opacity:.95;
        }

        .footer-text{
            color:#64748b;
            font-size:14px;
        }

        /* Tablet */

        @media (max-width:991px){

            .auth-card{
                max-width:450px;
            }

            .card-body{
                padding:2rem !important;
            }

            .icon-box{
                width:80px;
                height:80px;
                font-size:36px;
            }

        }

        /* Mobile */

        @media (max-width:576px){

            body{
                padding:15px;
            }

            .auth-card{
                border-radius:22px;
            }

            .card-body{
                padding:1.5rem !important;
            }

            .icon-box{
                width:70px;
                height:70px;
                font-size:30px;
                border-radius:18px;
            }

            h2{
                font-size:1.6rem;
            }

            .secure-badge{
                font-size:12px;
                padding:6px 12px;
            }

            .form-control{
                height:50px;
                font-size:14px;
            }

            .btn-unlock{
                height:50px;
                font-size:14px;
            }

            .blob-1{
                width:220px;
                height:220px;
            }

            .blob-2{
                width:180px;
                height:180px;
            }

        }

    </style>

</head>

<body>

<div class="blob blob-1"></div>

<div class="blob blob-2"></div>

<div class="card auth-card">

    <div class="card-body p-4 p-md-5">

        <div class="text-center mb-4">

            <div class="icon-box mb-4">
                🔒
            </div>

            <span class="secure-badge">
                Password Protected
            </span>

            <h2 class="fw-bold mt-4">
                Protected Link
            </h2>

            <p class="text-muted mb-0">
                This URL is secured with a password.
                Enter the password to continue.
            </p>

        </div>

        @error('password')

            <div class="alert alert-danger">

                {{ $message }}

            </div>

        @enderror

        <form
            method="POST"
            action="{{ route('urls.verify-password', $url) }}"
        >

            @csrf

            <div class="mb-3">

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter password"
                    required
                >

            </div>

            <button
                type="submit"
                class="btn btn-primary btn-unlock w-100"
            >
                Unlock Link →
            </button>

        </form>

        <div class="text-center mt-4">

            <small class="footer-text">
                Powered by <strong>Shortly</strong>
            </small>

        </div>

    </div>

</div>

</body>

</html>