<x-app-layout>

<div class="container mt-4 mb-4">

    <div class="analytics-hero">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2 class="fw-bold mb-3">
                    📊 URL Analytics
                </h2>

                <div class="short-url-box">

                    <div>
                        <strong>Short URL</strong>
                    </div>

                    <div>
                        {{ url($url->short_code) }}
                    </div>

                </div>

                <div class="mt-3">

                    <strong>Destination URL</strong>

                    <div class="text-light">
                        {{ $url->original_url }}
                    </div>

                </div>

                <div class="mt-3">

                    @if(!$url->expires_at)

                        <span class="badge bg-success status-badge">
                            Active
                        </span>

                    @elseif($url->expires_at > now())

                        <span class="badge bg-warning text-dark status-badge">
                            Expires Soon
                        </span>

                    @else

                        <span class="badge bg-danger status-badge">
                            Expired
                        </span>

                    @endif

                </div>

            </div>

            <div class="col-md-4 text-end">

                <a
                    href="{{ route('dashboard') }}"
                    class="btn btn-light"
                >
                    ← Dashboard
                </a>

            </div>

        </div>

    </div>  

    <div class="row mb-4 g-3">

        <div class="col-md-4">

            <div class="card analytics-card card-clicks">

                <div class="card-body">

                    <h6>Total Clicks</h6>

                    <h2 class="mb-0">
                        {{ $url->clicks }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card analytics-card card-visitors">

                <div class="card-body">

                    <h6>Unique Visitors</h6>

                    <h2 class="mb-0">
                        {{ $clicks->unique('ip_address')->count() }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card analytics-card card-shortcode">

                <div class="card-body">

                    <h6>Short Code</h6>

                    <h2 class="mb-0">
                        {{ $url->short_code }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card analytics-table">

        <div class="card-header">

            📈 Click Activity

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="analyticsTable"
                    class="table table-hover align-middle"
                >

                    <thead>

                        <tr>

                            <th>IP Address</th>
                            <th>Referrer</th>
                            <th>Date</th>
                            <th>Browser</th>
                            <th>Platform</th>
                            <th>Device</th>

                        </tr>

                    </thead>

                    <tbody>

                    @foreach($clicks as $click)

                        <tr>

                            <td>{{ $click->ip_address }}</td>

                            <td>
                                {{ $click->referer ?? 'Direct Visit' }}
                            </td>

                            <td>
                                {{ $click->created_at->format('d M Y h:i A') }}
                            </td>

                            <td>{{ $click->browser }}</td>

                            <td>{{ $click->platform }}</td>

                            <td>

                                <span class="badge bg-primary">

                                    {{ $click->device_type }}

                                </span>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>


$(document).ready(function () {

    $('#analyticsTable').DataTable({

        order: [[2, 'desc']],

        pageLength: 25

    });

});

</script>

</x-app-layout>