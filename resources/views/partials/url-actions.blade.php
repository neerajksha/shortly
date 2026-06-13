<td>

    <div class="dropstart">

    <button
        class="btn btn-primary btn-sm dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">
        Actions
    </button>

    <ul class="dropdown-menu shadow">

        <li>
            <button
                type="button"
                class="dropdown-item copy-btn"
                data-url="{{ url($url->short_code) }}"
            >
                📋 Copy URL
            </button>
        </li>

        <li>
            <button
                type="button"
                class="dropdown-item qr-btn"
                data-qr-url="{{ route('urls.qr', $url) }}"
            >
                🔲 Show QR
            </button>
        </li>

        <li>
            <a
                href="{{ route('urls.qr.download', $url) }}"
                class="dropdown-item"
            >
                📥 Download QR
            </a>
        </li>

        <li>
            <a
                href="{{ route('urls.analytics', $url) }}"
                class="dropdown-item"
            >
                📊 Analytics
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <form
                method="POST"
                action="{{ route('urls.destroy', $url) }}"
                onsubmit="return confirm('Delete this URL?')"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="dropdown-item text-danger"
                >
                    🗑 Delete
                </button>
            </form>
        </li>

    </ul>

</div>

</td>