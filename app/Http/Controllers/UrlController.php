<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;
use App\Rules\ReservedAlias;
use App\Services\AnalyticsService;
use Yajra\DataTables\Facades\DataTables;

class UrlController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function data()
    {
        $query = Url::query()
            ->where('user_id', auth()->id());

        return DataTables::eloquent($query)
            ->filter(function ($query) {

                if ($search = request('search.value')) {

                    $query->where(function ($q) use ($search) {

                        $q->where(
                            'short_code',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'original_url',
                            'like',
                            "%{$search}%"
                        );
                    });
                }
            })

            ->editColumn('short_code', function ($url) {
                return sprintf(
                    '<a href="%s" target="_blank">%s</a>',
                    url($url->short_code),
                    url($url->short_code)
                );
            })

            ->addColumn('actions', function ($url) {
                return view(
                    'partials.url-actions',
                    compact('url')
                )->render();
            })

            ->rawColumns([
                'short_code',
                'actions'
            ])

            ->make(true);
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
            ],
            'expires_at' => [
                'nullable',
                'date',
                'after:now'
            ],
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
            'expires_at' => $request->expires_at,
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

        if (
            $url->expires_at &&
            now()->greaterThan(
                $url->expires_at
            )
        ) {
            abort(
                410,
                'This link has expired.'
            );
        }

        AnalyticsService::track($url);

        return redirect(
            $url->original_url
        );
    }

    public function destroy(Url $url)
    {
        if ($url->user_id !== auth()->id()) {
            abort(403);
        }
        
        $url->delete();

        return back()->with(
            'success',
            'Short URL deleted successfully.'
        );
    }

    public function analytics(Url $url)
    {
        if ($url->user_id !== auth()->id()) {
            abort(403);
        }

        $clicks = $url->clicksData()
            ->latest()
            ->paginate(20);

        return view(
            'urls.analytics',
            compact('url', 'clicks')
        );
    }
}
