<x-app-layout>

<div class="container-fluid py-4">

    <!-- Hero -->

    <div
    class="card border-0 shadow-lg mb-3"
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
                    👤 User Profile
                </h4>

                <small class="text-white-50">
                    {{ $user->email }}
                </small>

            </div>

            <a
                href="{{ route('admin.users.index') }}"
                class="btn btn-light btn-sm"
            >
                ← Back
            </a>

        </div>

    </div>

</div>

    <!-- Stats -->

    <div class="row g-3 mb-4">

    <div class="col-md-3">

        <div
            class="card border-0 shadow-sm text-white"
            style="
                background:linear-gradient(135deg,#4f46e5,#6366f1);
                border-radius:16px;
            "
        >

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="opacity-75">
                            URLs
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $user->urls_count }}
                        </h4>

                    </div>

                    <span class="fs-3">
                        🔗
                    </span>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div
            class="card border-0 shadow-sm text-white"
            style="
                background:linear-gradient(135deg,#06b6d4,#22d3ee);
                border-radius:16px;
            "
        >

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="opacity-75">
                            Clicks
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $totalClicks }}
                        </h4>

                    </div>

                    <span class="fs-3">
                        📊
                    </span>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div
            class="card border-0 shadow-sm text-white"
            style="
                background:linear-gradient(135deg,#10b981,#34d399);
                border-radius:16px;
            "
        >

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="opacity-75">
                            Active URLs
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $activeUrls }}
                        </h4>

                    </div>

                    <span class="fs-3">
                        ⚡
                    </span>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div
            class="card border-0 shadow-sm text-white"
            style="
                background:linear-gradient(135deg,#f59e0b,#fbbf24);
                border-radius:16px;
            "
        >

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="opacity-75">
                            Status
                        </small>

                        <h5 class="fw-bold mb-0">

                            @if($user->is_active)
                                Active
                            @else
                                Suspended
                            @endif

                        </h5>

                    </div>

                    <span class="fs-3">
                        👤
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- User Information -->

    <div
        class="card border-0 shadow-lg mb-4"
        style="border-radius:20px;"
    >

        <div class="card-header bg-white border-0">

            <h5 class="mb-0">
                👤 User Information
            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <p>
                        <strong>Name</strong>
                        <br>
                        {{ $user->name }}
                    </p>

                    <p>
                        <strong>Email</strong>
                        <br>
                        {{ $user->email }}
                    </p>

                </div>

                <div class="col-md-6">

                    <p>
                        <strong>Joined</strong>
                        <br>
                        {{ $user->created_at->format('d M Y') }}
                    </p>

                    <p>
                        <strong>User ID</strong>
                        <br>
                        #{{ $user->id }}
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- URLs Table -->

    <div
        class="card border-0 shadow-lg"
        style="border-radius:20px;"
    >

        <div
            class="card-header bg-white border-0"
        >

            <h5 class="mb-0">
                🔗 User URLs
            </h5>

        </div>

        <div class="card-body">

            <table
                id="userUrlsTable"
                class="table table-hover align-middle"
                style="width:100%"
            >

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Short URL</th>

                        <th>Original URL</th>

                        <th>Clicks</th>

                        <th>Created</th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>

</div>

<style>

.card{
    transition:.3s;
}

.card:hover{
    transform:translateY(-2px);
}

.table-hover tbody tr:hover{
    background:#f8fafc;
}

#userUrlsTable thead th{
    border:none;
    font-weight:600;
}

.dataTables_wrapper .dataTables_filter input{
    border-radius:12px;
    padding:8px 12px;
}

.dataTables_wrapper .dataTables_length select{
    border-radius:12px;
}

</style>

@push('scripts')

<script>

$(function () {

    $('#userUrlsTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: '{{ route('admin.users.urls.data', $user) }}',

        order: [[0, 'desc']],

        columns: [

            {
                data: 'id'
            },

            {
                data: 'short_url'
            },

            {
                data: 'original_url'
            },

            {
                data: 'clicks'
            },

            {
                data: 'created_at'
            }

        ]

    });

});

</script>

@endpush

</x-app-layout>