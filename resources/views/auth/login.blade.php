<x-guest-layout>

<div class="container-fluid auth-wrapper">

<div class="row min-vh-100">

    @include('auth.partials.sidepanel')

    <div class="col-lg-6 d-flex align-items-center justify-content-center">

        <div
            class="card auth-card"
            style="
                width:100%;
                max-width:480px;
            "
        >

            <div class="card-body p-5">

                <div class="text-center mb-4">

                    <h2 class="fw-bold">
                        Welcome Back
                    </h2>

                    <p class="text-muted">
                        Login to your account
                    </p>

                </div>

                @if(session('status'))

                    <div class="alert alert-success">

                        {{ session('status') }}

                    </div>

                @endif

                <form
                    method="POST"
                    action="{{ route('login') }}"
                >

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required
                        >

                        @error('email')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                        >

                        @error('password')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>

                    <div class="d-flex justify-content-between mb-4">

                        <div class="form-check">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="remember"
                                id="remember"
                            >

                            <label
                                class="form-check-label"
                                for="remember"
                            >
                                Remember Me
                            </label>

                        </div>

                        @if(Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="text-decoration-none"
                            >
                                Forgot Password?
                            </a>

                        @endif

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100 py-2"
                    >
                        Login
                    </button>

                </form>

                <div class="text-center mt-4">

                    Don't have an account?

                    <a
                        href="{{ route('register') }}"
                        class="fw-bold text-decoration-none"
                    >
                        Register
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

</x-guest-layout>
