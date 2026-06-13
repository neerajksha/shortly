<x-app-layout>

<div class="container py-4">

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @if(session('success'))

        <div
            id="flash-success"
            data-message="{{ session('success') }}"
            hidden
        ></div>

    @endif

    <div class="hero-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">
                    🔗 Shorten. Share. Track.
                </h2>

                <p class="mb-0">
                    Create short links, custom aliases, QR codes and track clicks in real time.
                </p>
            </div>

            <div class="col-md-4 text-end">
                <h1>🚀</h1>
            </div>
        </div>
    </div>

    <!-- Stats Row -->

    <div class="row mb-4 g-3">

    <div class="col-md-3">
        <div class="card stat-card stat-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total URLs</small>
                    <h2>{{ auth()->user()->urls()->count() }}</h2>
                </div>
                <div class="stats-icon">🔗</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Clicks</small>
                    <h2>{{ auth()->user()->urls()->sum('clicks') }}</h2>
                </div>
                <div class="stats-icon">👆</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Active URLs</small>
                    <h2>
                        {{
                            auth()->user()
                                ->urls()
                                ->where(function ($q) {
                                    $q->whereNull('expires_at')
                                      ->orWhere('expires_at', '>', now());
                                })
                                ->count()
                        }}
                    </h2>
                </div>
                <div class="stats-icon">📈</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-danger">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Expired URLs</small>
                    <h2>
                        {{
                            auth()->user()
                                ->urls()
                                ->where('expires_at', '<', now())
                                ->count()
                        }}
                    </h2>
                </div>
                <div class="stats-icon">⏰</div>
            </div>
        </div>
    </div>

</div>

    <!-- Create URL Card -->

    <!-- <div class="card shadow-sm mb-4"> -->
    <div class="card shortener-card mb-4">

        <div class="card-header">

            <strong>
                Create Short URL
            </strong>

        </div>

        <div class="card-body">

            <form
                method="POST"
                action="{{ route('urls.store') }}"
            >

                @csrf

                <div class="row g-3">

                    <div class="col-md-4">

                        <input
                            type="url"
                            name="url"
                            class="form-control"
                            placeholder="Paste your long URL here..."
                            required
                        >

                    </div>

                    <div class="col-md-3">

                        <input
                            type="text"
                            name="short_code"
                            class="form-control"
                            placeholder="custom-alias"
                        >

                    </div>

                    <div class="col-md-3">

                        <input
                            type="datetime-local"
                            name="expires_at"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-shorten w-100"
                        >
                            🚀 Shorten URL
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- URLs Table -->

    <!-- <div class="card shadow-sm"> -->
    <div class="card table-card">

        <div class="card-header">

            <strong>
                My URLs
            </strong>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="urlsTable"
                    class="table table-striped table-hover align-middle"
                >

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Short URL</th>

                            <th>Original URL</th>

                            <th>Clicks</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- QR Modal -->

<div class="modal fade" id="qrModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold">
                    QR Code
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img
                    id="qr-image"
                    src=""
                    alt="QR Code"
                    class="img-fluid mx-auto d-block"
                    style="max-width:250px;"
                >

                <p class="text-muted mt-3 mb-0">
                    Scan to open the shortened URL
                </p>

            </div>

        </div>

    </div>

</div>

<!-- Toast -->

<div
    class="toast position-fixed top-0 end-0 m-3"
    id="appToast"
    role="alert"
>

    <div class="toast-body"></div>

</div>

@push('scripts')

    <script src="{{ asset('js/dashboard.js') }}"></script>

@endpush

</x-app-layout>