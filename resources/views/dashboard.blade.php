<x-app-layout>

    <div class="max-w-6xl mx-auto py-8">
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

</x-app-layout>