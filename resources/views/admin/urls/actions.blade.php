<div class="dropstart">

    <button
        class="btn btn-primary btn-sm dropdown-toggle"
        data-bs-toggle="dropdown"
    >
        Actions
    </button>

    <ul class="dropdown-menu">

        <li>

            <form
                method="POST"
                action="{{ route('admin.urls.toggle-status', $url) }}"
            >

                @csrf
                @method('PATCH')

                <button
                    class="dropdown-item"
                >

                    {{ $url->is_active
                        ? 'Disable URL'
                        : 'Enable URL' }}

                </button>

            </form>

        </li>

        <li>

            <a
                href="{{ route('admin.urls.analytics', $url) }}"
                class="dropdown-item"
            >
                Analytics
            </a>

        </li>

    </ul>

</div>