<div class="dropstart">

    <button
        class="btn btn-sm btn-primary dropdown-toggle"
        data-bs-toggle="dropdown"
    >
        Actions
    </button>

    <ul class="dropdown-menu">

        <li>

            <a
                href="{{ route('admin.users.show', $user) }}"
                class="dropdown-item"
            >
                View User
            </a>

        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>

            <form
                method="POST"
                action="{{ route('admin.users.toggle-status', $user) }}"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="dropdown-item"
                >

                    {{ $user->is_active
                        ? 'Suspend User'
                        : 'Activate User' }}

                </button>

            </form>

        </li>

    </ul>

</div>