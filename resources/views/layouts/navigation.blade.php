<nav class="navbar navbar-expand-lg navbar-custom">

    <div class="container">

        @php
            $dashboardRoute = auth()->check() && auth()->user()->is_admin
                ? route('admin.dashboard')
                : route('dashboard');
        @endphp

        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ $dashboardRoute }}">

            <div class="logo-circle">
                🔗
            </div>

            <div>

                <div class="fw-bold">
                    Shortly
                </div>

                <small class="text-light">
                    URL Shortener
                </small>

            </div>

        </a>

        <div class="ms-auto d-flex align-items-center gap-3">

            @if(auth()->user()->is_admin)
                <a href="{{ $dashboardRoute }}" class="nav-link">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    Manage Users
                </a>
                <a href="{{ route('admin.urls.index') }}" class="nav-link">
                    Manage URLs
                </a>
            @else
                <a href="{{ $dashboardRoute }}" class="nav-link">
                    Dashboard
                </a>
                <a
                    href="{{ route('api-tokens.index') }}"
                    class="nav-link"
                >
                    API Tokens
                </a>
            @endif

            <button
                class="user-menu dropdown-toggle"
                data-bs-toggle="dropdown"
            >
                {{ auth()->user()->name }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a
                        class="dropdown-item"
                        href="{{ route('profile.edit') }}"
                    >
                        Profile
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="dropdown-item text-danger"
                        >
                            Logout
                        </button>
                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>