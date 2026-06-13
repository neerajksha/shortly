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
                max-width:550px;
                width:100%;
                border-radius:24px;
            "
        >

            <div class="card-body p-5">

                <div class="text-center mb-4">

                    <div class="display-4 mb-3">
                        📧
                    </div>

                    <h2 class="fw-bold">
                        Check Your Inbox
                    </h2>

                    <p class="text-muted">
                        We've sent a verification link to your email address.
                        Click the link to activate your account.
                    </p>

                </div>

                @if (session('status') == 'verification-link-sent')

                    <div class="alert alert-success">

                        A new verification link has been sent to your email address.

                    </div>

                @endif

                <form
                    method="POST"
                    action="{{ route('verification.send') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary w-100 py-2 mb-3"
                    >
                        📨 Resend Verification Email
                    </button>

                </form>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-outline-secondary w-100"
                    >
                        Logout
                    </button>

                </form>

                <div class="text-center mt-4">

                    <small class="text-muted">
                        Didn't receive the email?
                        Check your spam folder or resend the verification email.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

</x-guest-layout>
