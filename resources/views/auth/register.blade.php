<x-guest-layout>

<div class="container-fluid auth-wrapper">

<div class="row min-vh-100">

    <!-- Left Branding Section -->

    @include('auth.partials.sidepanel')

    <!-- Register Form -->

    <div class="col-lg-6 d-flex align-items-center justify-content-center">

        <div class="card auth-card shadow-lg border-0" style="max-width:500px;width:100%;border-radius:24px;">

            <div class="card-body p-5">

                <div class="text-center mb-4">

                    <h2 class="fw-bold">
                        Create Account
                    </h2>

                    <p class="text-muted">
                        Start shortening links today
                    </p>

                </div>

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            required
                        >

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

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

                    <div class="mb-4">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100 py-2"
                    >
                        Create Account
                    </button>

                </form>

                <div class="text-center mt-4">

                    Already have an account?

                    <a
                        href="{{ route('login') }}"
                        class="fw-bold text-decoration-none"
                    >
                        Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

</x-guest-layout>
