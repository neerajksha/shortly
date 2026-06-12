<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;
use App\Rules\ReservedAlias;

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
            'url' => ['required', 'url'],
            'short_code' => [
                'nullable',
                'alpha_dash', // Only letters, numbers, dashes (-), and underscores (_)
                'unique:urls,short_code',
                new ReservedAlias(),
            ]
        ]);

        if ($request->short_code) {
            $code = strtolower($request->short_code);
        } else {

            do {
                $code = strtolower(Str::random(6));
            } while (
                Url::where('short_code', $code)->exists()
            );
        }

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
