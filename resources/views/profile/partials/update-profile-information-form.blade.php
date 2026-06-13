<section>

<form
    id="send-verification"
    method="POST"
    action="{{ route('verification.send') }}"
>
    @csrf
</form>

<form
    method="POST"
    action="{{ route('profile.update') }}"
>

    @csrf
    @method('PATCH')

    <div class="mb-3">

        <label
            for="name"
            class="form-label fw-semibold"
        >
            Full Name
        </label>

        <input
            id="name"
            name="name"
            type="text"
            class="form-control"
            value="{{ old('name', $user->name) }}"
            required
            autofocus
        >

        @error('name')

            <div class="text-danger small mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>

    <div class="mb-3">

        <label
            for="email"
            class="form-label fw-semibold"
        >
            Email Address
        </label>

        <input
            id="email"
            name="email"
            type="email"
            class="form-control"
            value="{{ old('email', $user->email) }}"
            required
        >

        @error('email')

            <div class="text-danger small mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

        <div class="alert alert-warning">

            <strong>
                Email not verified.
            </strong>

            <br>

            <button
                form="send-verification"
                class="btn btn-link p-0"
            >
                Click here to resend verification email
            </button>

        </div>

        @if (session('status') === 'verification-link-sent')

            <div class="alert alert-success">

                Verification link has been sent successfully.

            </div>

        @endif

    @endif

    <div class="d-flex align-items-center gap-3">

        <button
            type="submit"
            class="btn btn-primary"
        >
            Save Changes
        </button>

        @if (session('status') === 'profile-updated')

            <span class="text-success">
                ✓ Saved Successfully
            </span>

        @endif

    </div>

</form>

</section>
