<x-guest-layout>

<div class="container-fluid auth-wrapper">

<div class="row min-vh-100">

    <!-- Left Branding Section -->

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

                    <div class="fs-1 mb-3">
                        🔐
                    </div>

                    <h2 class="fw-bold">
                        Confirm Password
                    </h2>

                    <p class="text-muted">
                        This is a secure area. Please enter your password
                        to continue.
                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route('password.confirm') }}"
                >

                    @csrf

                    <div class="mb-4">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                            autocomplete="current-password"
                        >

                        @error('password')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100 py-2"
                    >
                        🔒 Confirm Password
                    </button>

                </form>

                <div class="text-center mt-4">

                    <a
                        href="{{ route('dashboard') }}"
                        class="text-decoration-none"
                    >
                        ← Back to Dashboard
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

</x-guest-layout>
