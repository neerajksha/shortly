
<x-app-layout>

<div class="container-fluid py-4">

    
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
                            Total Users
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $usersCount }}
                        </h4>

                    </div>

                    <span class="fs-3">
                        👥
                    </span>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div
            class="card border-0 shadow-sm text-white"
            style="
                background:linear-gradient(135deg,#7c3aed,#8b5cf6);
                border-radius:16px;
            "
        >

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="opacity-75">
                            Total URLs
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $urlsCount }}
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
                            Total Clicks
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $clicksCount }}
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

</div>

    <!-- Quick Actions Here -->
    <div class="row g-3 mb-4">

        <div class="col-md-6">

            <div
                class="card border-0 shadow-sm"
                style="border-radius:16px;"
            >

                <div class="card-body p-3">

                    <div class="d-flex align-items-center">

                        <div
                            class="me-3 d-flex align-items-center justify-content-center"
                            style="
                                width:55px;
                                height:55px;
                                border-radius:14px;
                                background:rgba(79,70,229,.1);
                                font-size:24px;
                            "
                        >
                            👥
                        </div>

                        <div class="flex-grow-1">

                            <h6 class="fw-bold mb-1">
                                Manage Users
                            </h6>

                            <small class="text-muted">
                                View and manage users
                            </small>

                        </div>

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="btn btn-primary btn-sm px-3"
                        >
                            Open
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div
                class="card border-0 shadow-sm"
                style="border-radius:16px;"
            >

                <div class="card-body p-3">

                    <div class="d-flex align-items-center">

                        <div
                            class="me-3 d-flex align-items-center justify-content-center"
                            style="
                                width:55px;
                                height:55px;
                                border-radius:14px;
                                background:rgba(16,185,129,.1);
                                font-size:24px;
                            "
                        >
                            🔗
                        </div>

                        <div class="flex-grow-1">

                            <h6 class="fw-bold mb-1">
                                Manage URLs
                            </h6>

                            <small class="text-muted">
                                Review shortened links
                            </small>

                        </div>

                        <a
                            href="{{ route('admin.urls.index') }}"
                            class="btn btn-primary btn-sm px-3"
                        >
                            Open
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
    
    <!-- Chart After Quick Actions -->
    <div class="card border-0 shadow-lg mb-4" style="border-radius:20px;max-height:350px;">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">📈 Click Activity (Last 30 Days)</h5>
        </div>
        <div class="card-body" style="height:280px">
            <canvas id="clicksChart" height="55"></canvas>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100" style="border-radius:20px;">
                <div class="card-header bg-white"><h5 class="mb-0">🏆 Top URLs</h5></div>
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <tbody>
                        @foreach($topUrls as $url)
                            <tr>
                                <td><strong>{{ $url->short_code }}</strong></td>
                                <td class="text-end">
                                    <span class="badge bg-primary">{{ $url->clicks }} Clicks</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100" style="border-radius:20px;">
                <div class="card-header bg-white"><h5 class="mb-0">👥 Top Users</h5></div>
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <tbody>
                        @foreach($topUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td class="text-end">
                                    <span class="badge bg-success">{{ $user->urls_count }} URLs</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-1">

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg" style="border-radius:20px;">
                <div class="card-header bg-white"><h5 class="mb-0">🌐 Top Browsers</h5></div>
                <div class="card-body">
                    <table class="table table-hover">
                        @foreach($topBrowsers as $browser)
                            <tr>
                                <td>{{ $browser->browser }}</td>
                                <td class="text-end">
                                    <span class="badge bg-info">{{ $browser->total }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg" style="border-radius:20px;">
                <div class="card-header bg-white"><h5 class="mb-0">🚀 Top Referrers</h5></div>
                <div class="card-body">
                    <table class="table table-hover">
                        @foreach($topReferrers as $referrer)
                            <tr>
                                <td>{{ Str::limit($referrer->referer, 50) }}</td>
                                <td class="text-end">
                                    <span class="badge bg-warning text-dark">{{ $referrer->total }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>

   

</div>

@push('scripts')
<script>
const chartData = @json($clicksLast30Days);

new Chart(
    document.getElementById('clicksChart'),
    {
        type: 'line',

        data: {

            labels: chartData.map(
                item => item.day
            ),

            datasets: [{

                label: 'Clicks',

                data: chartData.map(
                    item => item.total
                ),

                borderColor: '#4f46e5',

                backgroundColor:
                    'rgba(79,70,229,.12)',

                fill: true,

                tension: 0.4,

                borderWidth: 3,

                pointRadius: 4,

                pointBackgroundColor:
                    '#4f46e5'

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: false

                }

            }

        }

    }
);
</script>
@endpush

</x-app-layout>

