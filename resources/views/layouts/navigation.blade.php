<nav class="navbar navbar-expand-lg navbar-custom">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('dashboard') }}">

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

            <a href="{{ route('dashboard') }}" class="nav-link">
                Dashboard
            </a>

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