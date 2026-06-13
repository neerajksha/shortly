<x-guest-layout>

<div class="container-fluid auth-wrapper">

<div class="row min-vh-100">

    <!-- Left Section -->

    @include('auth.partials.sidepanel')

    <!-- Right Section -->

    <div class="col-lg-6 d-flex align-items-center justify-content-center">

        <div
            class="card auth-card shadow-lg border-0"
            style="
                max-width:520px;
                width:100%;
                border-radius:24px;
            "
        >

            <div class="card-body p-5">

                <div class="text-center mb-4">

                    <div class="fs-1 mb-3">
                        🔑
                    </div>

                    <h2 class="fw-bold">
                        Reset Password
                    </h2>

                    <p class="text-muted">
                        Enter your new password below.
                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route('password.store') }}"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}"
                    >

                    <div class="mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $request->email) }}"
                            required
                            readonly
                        >

                        @error('email')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            New Password
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

                        @error('password_confirmation')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100 py-2"
                    >
                        🔒 Reset Password
                    </button>

                </form>

                <div class="text-center mt-4">

                    <a
                        href="{{ route('login') }}"
                        class="text-decoration-none fw-semibold"
                    >
                        ← Back to Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

</x-guest-layout>
