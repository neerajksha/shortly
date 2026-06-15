<x-app-layout>

<div class="container-fluid py-4">

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
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    <!-- Hero Section -->

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

                    <h4 class="fw-bold text-white mb-0">
                        👥 Users Management
                    </h4>

                    <small class="text-white-50">
                        Manage platform users
                    </small>

                </div>

                <span
                    style="
                        font-size:32px;
                        opacity:.8;
                    "
                >
                    👤
                </span>

            </div>

        </div>

    </div>

    <!-- Stats -->

    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div
                class="card border-0 shadow-lg text-white"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        #4f46e5,
                        #6366f1
                    );
                    border-radius:20px;
                "
            >

                <div class="card-body">

                    <h6>
                        Total Users
                    </h6>

                    <h2 class="fw-bold">
                        {{ \App\Models\User::where('is_admin', false)->count() }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div
                class="card border-0 shadow-lg text-white"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        #10b981,
                        #34d399
                    );
                    border-radius:20px;
                "
            >

                <div class="card-body">

                    <h6>
                        Active Users
                    </h6>

                    <h2 class="fw-bold">
                        {{
                            \App\Models\User::where(
                                'is_active',
                                 true
                            )->where('is_admin', false)->count()
                        }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div
                class="card border-0 shadow-lg text-white"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        #ef4444,
                        #f87171
                    );
                    border-radius:20px;
                "
            >

                <div class="card-body">

                    <h6>
                        Suspended Users
                    </h6>

                    <h2 class="fw-bold">
                        {{
                            \App\Models\User::where(
                                'is_active',
                                 false
                            )->where('is_admin', false)->count()
                        }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Users Table -->

    <div
        class="card border-0 shadow-lg"
        style="
            border-radius:24px;
        "
    >

        <div
            class="card-header bg-white border-0 py-3"
        >

            <h5 class="mb-0 fw-bold">
                👥 Users List
            </h5>

        </div>

        <div class="card-body">

            <table
                id="usersTable"
                class="table table-hover align-middle"
                style="width:100%"
            >

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Status</th>

                        <th>URLs</th>

                        <th>Joined</th>

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
    transform:translateY(-2px);
}

#usersTable thead th{

    border:none;

    font-weight:600;

    color:#475569;
}

.table-hover tbody tr:hover{

    background:#f8fafc;
}

.dataTables_wrapper .dataTables_filter input{

    border:1px solid #e2e8f0;

    border-radius:12px;

    padding:8px 12px;
}

.dataTables_wrapper .dataTables_length select{

    border:1px solid #e2e8f0;

    border-radius:12px;

    padding:6px 10px;
}

.paginate_button.current{

    background:
    linear-gradient(
        135deg,
        #4f46e5,
        #7c3aed
    ) !important;

    color:white !important;

    border:none !important;

    border-radius:10px !important;
}

</style>

@push('scripts')

<script>

$(function () {

    $('#usersTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: '{{ route('admin.users.data') }}',

        order: [[0, 'desc']],

        pageLength: 10,

        columns: [

            {
                data: 'id'
            },

            {
                data: 'name'
            },

            {
                data: 'email'
            },

            {
                data: 'status',
                orderable: false
            },

            {
                data: 'urls_count',
                orderable: false,
                searchable: false
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