<section>

<div class="mb-4">

    <h4 class="fw-bold text-danger mb-1">
        Delete Account
    </h4>

    <p class="text-muted">
        Once your account is deleted, all of its resources and data will be permanently removed. This action cannot be undone.
    </p>

</div>

<button
    type="button"
    class="btn btn-danger"
    data-bs-toggle="modal"
    data-bs-target="#deleteAccountModal"
>
    Delete Account
</button>

<!-- Delete Account Modal -->

<div
    class="modal fade"
    id="deleteAccountModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                method="POST"
                action="{{ route('profile.destroy') }}"
            >

                @csrf
                @method('DELETE')

                <div class="modal-header">

                    <h5 class="modal-title text-danger">
                        Confirm Account Deletion
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <div class="modal-body">

                    <p>
                        Are you sure you want to delete your account?
                    </p>

                    <p class="text-muted small">
                        Once deleted, all URLs, analytics, and account data will be permanently removed.
                    </p>

                    <div class="mb-3">

                        <label
                            for="password"
                            class="form-label fw-semibold"
                        >
                            Enter Password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required
                        >

                        @if($errors->userDeletion->has('password'))

                            <div class="text-danger small mt-1">

                                {{ $errors->userDeletion->first('password') }}

                            </div>

                        @endif

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Delete Account
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</section>
