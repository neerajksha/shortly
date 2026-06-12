<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        $urls = auth()->user()
            ->urls()
            ->latest()
            ->get();

        return view('dashboard', compact('urls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url']
        ]);

        do {
            $code = Str::random(6);
        } while (
            Url::where('short_code', $code)->exists()
        );

        Url::create([
            'user_id' => auth()->id(),
            'original_url' => $request->url,
            'short_code' => $code,
        ]);

        return back()
            ->with('success', 'Short URL created.');
    }

    public function redirect($code)
    {
        $url = Url::where(
            'short_code',
            $code
        )->firstOrFail();

        $url->increment('clicks');

        return redirect(
            $url->original_url
        );
    }
}
