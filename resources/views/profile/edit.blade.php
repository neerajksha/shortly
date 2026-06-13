<x-app-layout>

<div class="container py-4">

<!-- Hero Section -->

<div class="card border-0 shadow-lg mb-4">

    <div
        class="card-body text-white"
        style="
            background: linear-gradient(135deg,#4f46e5,#7c3aed);
            border-radius: 16px;
        "
    >

        <h2 class="fw-bold mb-1">
            👤 My Profile
        </h2>

        <p class="mb-0">
            Manage your account information and security settings.
        </p>

    </div>

</div>

<div class="row g-4">

    <!-- User Card -->

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center p-4">

                <div
                    class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold"
                    style="
                        width:90px;
                        height:90px;
                        background:linear-gradient(135deg,#4f46e5,#7c3aed);
                        font-size:32px;
                    "
                >

                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                </div>

                <h4 class="mt-3">
                    {{ Auth::user()->name }}
                </h4>

                <p class="text-muted">
                    {{ Auth::user()->email }}
                </p>

                <span class="badge bg-success">
                    Active Account
                </span>

            </div>

        </div>

    </div>

    <!-- Settings -->

    <div class="col-lg-8">

        <!-- Profile Information -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    ✏️ Profile Information
                </h5>

            </div>

            <div class="card-body">

                @include('profile.partials.update-profile-information-form')

            </div>

        </div>

        <!-- Password -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    🔒 Update Password
                </h5>

            </div>

            <div class="card-body">

                @include('profile.partials.update-password-form')

            </div>

        </div>

        <!-- Delete Account -->

        <div class="card border-danger shadow-sm">

            <div class="card-header bg-danger text-white">

                <h5 class="mb-0">
                    🗑️ Danger Zone
                </h5>

            </div>

            <div class="card-body">

                @include('profile.partials.delete-user-form')

            </div>

        </div>

    </div>

</div>
```

</div>

</x-app-layout>
