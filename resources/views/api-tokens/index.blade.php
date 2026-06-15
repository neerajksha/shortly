<x-app-layout>

<div class="container py-4">

    <!-- Hero -->

    <div
        class="card border-0 shadow-lg mb-4"
        style="
            border-radius:20px;
            background:
            linear-gradient(
                135deg,
                #4f46e5,
                #7c3aed
            );
        "
    >

        <div class="card-body px-4 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="fw-bold text-white mb-1">
                        🔑 API Tokens
                    </h4>

                    <small class="text-white-50">
                        Generate and manage personal access tokens
                    </small>

                </div>

                <div style="font-size:32px;">
                    🔐
                </div>

            </div>

        </div>

    </div>

    @if(session('plainTextToken'))

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:16px;"
        >

            <div class="card-body">

                <h5 class="text-success mb-3">
                    ✅ Token Created Successfully
                </h5>

                <p class="text-muted">
                    Copy this token now. It will never be shown again.
                </p>

                <div class="input-group">

                    <input
                        type="text"
                        readonly
                        class="form-control"
                        value="{{ session('plainTextToken') }}"
                        id="generatedToken"
                    >

                    <button
                        type="button"
                        class="btn btn-success"
                        id="copyTokenBtn"
                    >
                        📋 Copy
                    </button>

                </div>

            </div>

        </div>

    @endif

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- Stats -->

    <div class="row g-3 mb-4">

        <div class="col-md-4">

            <div
                class="card border-0 shadow-sm text-white"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        #4f46e5,
                        #6366f1
                    );
                    border-radius:16px;
                "
            >

                <div class="card-body p-3">

                    <div
                        class="d-flex justify-content-between align-items-center"
                    >

                        <div>

                            <small class="opacity-75">
                                Total Tokens
                            </small>

                            <h4 class="fw-bold mb-0">
                                {{ $tokens->count() }}
                            </h4>

                        </div>

                        <span class="fs-3">
                            🔑
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Generate Token -->

    <div
        class="card border-0 shadow-sm mb-4"
        style="border-radius:16px;"
    >

        <div class="card-header bg-white">

            <h6 class="fw-bold mb-0">
                ➕ Generate New Token
            </h6>

        </div>

        <div class="card-body">

            <form
                method="POST"
                action="{{ route('api-tokens.store') }}"
            >

                @csrf

                <div class="row g-3">

                    <div class="col-md-9">

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Production Token"
                            required
                        >

                    </div>

                    <div class="col-md-3">

                        <button
                            class="btn btn-primary w-100"
                        >
                            Generate Token
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Tokens List -->

    <div
        class="card border-0 shadow-sm"
        style="border-radius:16px;"
    >

        <div class="card-header bg-white">

            <h6 class="fw-bold mb-0">
                📋 My Tokens
            </h6>

        </div>

        <div class="card-body">

            @if($tokens->count())

                <div class="table-responsive">

                    <table
                        class="table table-hover align-middle"
                    >

                        <thead>

                            <tr>

                                <th>Name</th>

                                <th>Created</th>

                                <th>Last Used</th>

                                <th width="150">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($tokens as $token)

                            <tr>

                                <td>

                                    <strong>

                                        {{ $token->name }}

                                    </strong>

                                </td>

                                <td>

                                    {{ $token->created_at->format('d M Y h:i A') }}

                                </td>

                                <td>

                                    {{
                                        $token->last_used_at
                                        ? $token->last_used_at->diffForHumans()
                                        : 'Never'
                                    }}

                                </td>

                                <td>

                                    <form
                                        action="{{ route('api-tokens.destroy', $token) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this token?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-outline-danger btn-sm px-3"
                                        >
                                            🗑 Revoke
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <div class="display-4 mb-3">
                        🔑
                    </div>

                    <h5>
                        No API Tokens Yet
                    </h5>

                    <p class="text-muted">
                        Generate your first API token to access the Shortly API.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    () => {

        document
            .getElementById(
                'copyTokenBtn'
            )
            ?.addEventListener(
                'click',
                async () => {

                    const token =
                        document.getElementById(
                            'generatedToken'
                        );

                    try {

                        await navigator
                            .clipboard
                            .writeText(
                                token.value
                            );

                        alert(
                            'Token copied successfully.'
                        );

                    } catch {

                        token.select();

                        document.execCommand(
                            'copy'
                        );

                        alert(
                            'Token copied successfully.'
                        );

                    }

                }
            );

    }
);

</script>

@endpush

</x-app-layout>
