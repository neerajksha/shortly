<x-app-layout>

<div class="container-fluid py-4">

    <!-- Hero Section -->

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
                        📊 URL Analytics
                    </h4>

                    <small class="text-white-50">
                        {{ url($url->short_code) }}
                    </small>

                </div>

                <a
                    href="{{ route('admin.urls.index') }}"
                    class="btn btn-light btn-sm"
                >
                    ← Back
                </a>

            </div>

        </div>

    </div>

    <!-- Stats Cards -->

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
                                Owner
                            </small>

                            <h5 class="fw-bold mb-0">
                                {{ \Illuminate\Support\Str::limit($url->user->name, 12) }}
                            </h5>

                        </div>

                        <span class="fs-3">
                            👤
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
                                {{ $url->clicks }}
                            </h4>

                        </div>

                        <span class="fs-3">
                            📈
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
                                Visitors
                            </small>

                            <h4 class="fw-bold mb-0">
                                {{ $uniqueVisitors }}
                            </h4>

                        </div>

                        <span class="fs-3">
                            🌎
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

                                @if($url->is_active)
                                    Active
                                @else
                                    Disabled
                                @endif

                            </h5>

                        </div>

                        <span class="fs-3">
                            ⚡
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- URL Information -->

    <div
    class="card border-0 shadow-sm mb-4"
    style="border-radius:16px;"
>

    <div class="card-header bg-white border-0 py-3">

        <h6 class="fw-bold mb-0">
            🔗 URL Information
        </h6>

    </div>

    <div class="card-body p-3">

        <div class="row g-3">

            <div class="col-md-6">

                <small class="text-muted d-block mb-1">
                    Short URL
                </small>

                <div
                    class="bg-light rounded-3 p-2"
                >

                    <a
                        href="{{ url($url->short_code) }}"
                        target="_blank"
                        class="text-decoration-none"
                    >
                        {{ url($url->short_code) }}
                    </a>

                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block mb-1">
                    Short Code
                </small>

                <div
                    class="bg-light rounded-3 p-2"
                >

                    {{ $url->short_code }}

                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block mb-1">
                    Created At
                </small>

                <div
                    class="bg-light rounded-3 p-2"
                >

                    {{ $url->created_at->format('d M Y h:i A') }}

                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block mb-1">
                    Expires At
                </small>

                <div
                    class="bg-light rounded-3 p-2"
                >

                    {{
                        $url->expires_at
                        ? \Carbon\Carbon::parse($url->expires_at)->format('d M Y h:i A')
                        : 'Never'
                    }}

                </div>

            </div>

            <div class="col-12">

                <small class="text-muted d-block mb-1">
                    Original URL
                </small>

                <div
                    class="bg-light rounded-3 p-2 text-break"
                >

                    {{ $url->original_url }}

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- Click Logs -->

    <div
        class="card border-0 shadow-lg"
        style="border-radius:20px;"
    >

        <div
            class="card-header bg-white border-0 py-3"
        >

            <h5 class="mb-0">
                📋 Click Logs
            </h5>

        </div>

        <div class="card-body">

            <table
                id="analyticsTable"
                class="table table-hover align-middle"
                style="width:100%"
            >

                <thead class="table-light">

                    <tr>

                        <th>IP Address</th>

                        <th>Browser</th>

                        <th>Platform</th>

                        <th>Device</th>

                        <th>Referrer</th>

                        <th>Date</th>

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
    transform:translateY(-3px);
}

.table-hover tbody tr:hover{
    background:#f8fafc;
}

.dataTables_wrapper .dataTables_filter input{
    border-radius:12px;
    border:1px solid #e5e7eb;
    padding:8px 12px;
}

.dataTables_wrapper .dataTables_length select{
    border-radius:12px;
}

#analyticsTable thead th{
    border:none;
    font-weight:600;
}

.bg-light{
    background:#f8fafc !important;
}

.card{
    border:none;
}

.info-box{
    background:#f8fafc;
    border-radius:12px;
    padding:12px;
}

</style>

@push('scripts')

<script>

$(function () {

    $('#analyticsTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: '{{ route('admin.urls.analytics.data', $url) }}',

        order: [[5, 'desc']],

        columns: [

            {
                data: 'ip_address'
            },

            {
                data: 'browser'
            },

            {
                data: 'platform'
            },

            {
                data: 'device_type'
            },

            {
                data: 'referer'
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