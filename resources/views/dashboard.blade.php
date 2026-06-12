<x-app-layout>

    <div class="max-w-6xl mx-auto py-8">

        <div id="toast" class="hidden fixed top-5 right-5 bg-green-600 text-blue-500 px-4 py-2 rounded shadow-lg z-50" style="margin: 50px;"></div>
        @if ($errors->any())

            <div class="mb-4">

                @foreach ($errors->all() as $error)

                    <p class="text-red-500">
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif

        

        <form method="POST" action="{{ route('urls.store') }}">
            @csrf

            <div class="flex gap-3">
                <input
                    type="url"
                    name="url"
                    placeholder="https://example.com"
                    class="border rounded p-2 flex-1"
                    required
                >
                <input
                    type="text"
                    name="short_code"
                    placeholder="Custom alias (optional)"
                    class="border rounded p-2 flex-1"
                />

                <button
                    class="bg-black text-white px-4 py-2 rounded"
                >
                    Shorten
                </button>
            </div>
        </form>

        <div class="mt-8">

            <table class="w-full border">

                <thead>
                    <tr>
                        <th>Short URL</th>
                        <th>Original URL</th>
                        <th>Clicks</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($urls as $url)

                    <tr>
                        <td>
                            <a
                                href="{{ url($url->short_code) }}"
                                target="_blank"
                            >
                                {{ url($url->short_code) }}
                            </a>
                            <button
                                type="button"
                                class="copy-btn px-2 py-1 text-sm bg-gray-200 rounded hover:bg-gray-300"
                                data-url="{{ url($url->short_code) }}"
                            >
                                Copy
                            </button>
                        </td>

                        <td>
                            {{ Str::limit($url->original_url, 50) }}
                        </td>

                        <td>
                            {{ $url->clicks }}
                        </td>
                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>
    @push('scripts')
        <script src="{{ asset('js/dashboard.js') }}"></script>
    @endpush

</x-app-layout>