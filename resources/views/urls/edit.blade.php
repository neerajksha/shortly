<x-app-layout>

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header">

            Edit URL

        </div>

        <div class="card-body">

            <form
                method="POST"
                action="{{ route('urls.update', $url) }}"
            >

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Original URL
                    </label>

                    <input
                        type="url"
                        name="original_url"
                        class="form-control"
                        value="{{ old('original_url', $url->original_url) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Custom Alias
                    </label>

                    <input
                        type="text"
                        name="short_code"
                        class="form-control"
                        value="{{ old('short_code', $url->short_code) }}"
                    >

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Expiration Date
                    </label>

                    <input
                        type="datetime-local"
                        name="expires_at"
                        class="form-control"
                        value="{{ $url->expires_at ? \Carbon\Carbon::parse($url->expires_at)->format('Y-m-d\TH:i') : '' }}"
                    >

                </div>

                @if($url->password)

                    <div class="alert alert-success">

                        <strong>🔒 Password Protected</strong>

                        <br>

                        This link is currently protected by a password.

                        <br>

                        Enter a new password below to replace it.

                    </div>

                @else

                    <div class="alert alert-secondary">

                        <strong>🔓 Not Protected</strong>

                        <br>

                        This link does not have password protection.

                    </div>

                @endif

                <div class="mb-3">

                    <label class="form-label">

                        New Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter new password"
                        maxlength="16"
                        minlength="4"
                    >

                    <small class="text-muted">

                        Leave blank to keep the current password.

                    </small>

                </div>

                @if($url->password)

                    <div class="form-check mb-3">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remove_password"
                            value="1"
                            id="removePassword"
                        >

                        <label
                            class="form-check-label"
                            for="removePassword"
                        >

                            Remove Password Protection

                        </label>

                    </div>

                @endif

                <button
                    class="btn btn-primary"
                >
                    Update URL
                </button>

                <a
                    href="{{ route('dashboard') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

</x-app-layout>