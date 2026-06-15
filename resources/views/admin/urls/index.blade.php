<x-app-layout>

<div class="container-fluid py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">
            {{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                    🔗 URL Management
                </h4>

                <small class="text-white-50">
                    Manage all shortened URLs
                </small>

            </div>

            <div
                style="
                    font-size:32px;
                    opacity:.85;
                "
            >
                🚀
            </div>

        </div>

    </div>

</div>

    <!-- Table -->

    <div
        class="card border-0 shadow-lg"
        style="border-radius:20px;"
    >

        <div
            class="card-header bg-white border-0 py-3"
        >

            <h5 class="mb-0">
                📋 All URLs
            </h5>

        </div>

        <div class="card-body">

            <table
                id="adminUrlsTable"
                class="table table-hover align-middle"
                style="width:100%"
            >

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Owner</th>

                        <th>Short Code</th>

                        <th>Original URL</th>

                        <th>Clicks</th>

                        <th>Status</th>

                        <th>Created</th>

                        <th>Actions</th>

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
    border:1px solid #e5e7eb;
}

#adminUrlsTable thead th{
    font-weight:600;
    border:none;
}

.badge{
    border-radius:10px;
}

</style>

@push('scripts')

<script>

$(function () {

    $('#adminUrlsTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: '{{ route('admin.urls.data') }}',

        order: [[0, 'desc']],

        pageLength: 10,

        columns: [

            {
                data: 'id'
            },

            {
                data: 'owner'
            },

            {
                data: 'short_code'
            },

            {
                data: 'original_url'
            },

            {
                data: 'clicks'
            },

            {
                data: 'status'
            },

            {
                data: 'created_at'
            },

            {
                data: 'actions',
                orderable: false,
                searchable: false
            }

        ]

    });

});

</script>

@endpush

</x-app-layout>