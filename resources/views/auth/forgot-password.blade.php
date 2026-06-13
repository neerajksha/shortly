<x-guest-layout>

<div class="container-fluid auth-wrapper">
<div class="row min-vh-100">

    <!-- Left Side -->

    @include('auth.partials.sidepanel')

    <!-- Right Side -->

    <div class="col-lg-6 d-flex align-items-center justify-content-center">

        <div
            class="card auth-card shadow-lg border-0"
            style="
                max-width:500px;
                width:100%;
                border-radius:24px;
            "
        >

            <div class="card-body p-5">

                <div class="text-center mb-4">

                    <div class="mb-3 fs-1">
                        🔑
                    </div>

                    <h2 class="fw-bold">
                        Forgot Password?
                    </h2>

                    <p class="text-muted">
                        Enter your email and we'll send you a reset link.
                    </p>

                </div>

                @if (session('status'))

                    <div class="alert alert-success">

                        {{ session('status') }}

                    </div>

                @endif

                <form
                    method="POST"
                    action="{{ route('password.email') }}"
                >

                    @csrf

                    <div class="mb-4">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >

                        @error('email')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100 py-2"
                    >
                        📧 Send Reset Link
                    </button>

                </form>

                <div class="text-center mt-4">

                    Remember your password?

                    <a
                        href="{{ route('login') }}"
                        class="fw-bold text-decoration-none"
                    >
                        Back to Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

</x-guest-layout>
