<section>

<form
    method="POST"
    action="{{ route('password.update') }}"
>

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label
            for="update_password_current_password"
            class="form-label fw-semibold"
        >
            Current Password
        </label>

        <input
            id="update_password_current_password"
            name="current_password"
            type="password"
            class="form-control"
            autocomplete="current-password"
        >

        @if ($errors->updatePassword->has('current_password'))

            <div class="text-danger small mt-1">

                {{ $errors->updatePassword->first('current_password') }}

            </div>

        @endif

    </div>

    <div class="mb-3">

        <label
            for="update_password_password"
            class="form-label fw-semibold"
        >
            New Password
        </label>

        <input
            id="update_password_password"
            name="password"
            type="password"
            class="form-control"
            autocomplete="new-password"
        >

        @if ($errors->updatePassword->has('password'))

            <div class="text-danger small mt-1">

                {{ $errors->updatePassword->first('password') }}

            </div>

        @endif

    </div>

    <div class="mb-4">

        <label
            for="update_password_password_confirmation"
            class="form-label fw-semibold"
        >
            Confirm Password
        </label>

        <input
            id="update_password_password_confirmation"
            name="password_confirmation"
            type="password"
            class="form-control"
            autocomplete="new-password"
        >

        @if ($errors->updatePassword->has('password_confirmation'))

            <div class="text-danger small mt-1">

                {{ $errors->updatePassword->first('password_confirmation') }}

            </div>

        @endif

    </div>

    <div class="d-flex align-items-center gap-3">

        <button
            type="submit"
            class="btn btn-primary"
        >
            Update Password
        </button>

        @if (session('status') === 'password-updated')

            <span class="text-success">
                ✓ Password Updated Successfully
            </span>

        @endif

    </div>

</form>

</section>
