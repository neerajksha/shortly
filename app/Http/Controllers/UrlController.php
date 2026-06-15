<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;
use App\Rules\ReservedAlias;
use App\Services\AnalyticsService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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

                $badge = $url->password
                    ? '<span class="badge bg-warning text-dark ms-1">🔒 Protected</span>'
                    : '<span class="badge bg-success ms-1">Public</span>';

                return sprintf(
                    '<a href="%s" target="_blank">%s</a> %s',
                    url($url->short_code),
                    url($url->short_code),
                    $badge
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
            'password' => [
                'nullable',
                'min:4',
                'max:16'
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

        $password = $request->filled('password')
        ? Hash::make($request->password)
        : null;

        Url::create([
            'user_id' => auth()->id(),
            'original_url' => $request->url,
            'short_code' => $code,
            'expires_at' => $request->expires_at,
            'password' => $password,
        ]);

        return back()
            ->with('success', 'Short URL created successfully.');
    }

    public function redirect($code)
    {
        $url = Url::where(
            'short_code',
            $code
        )->firstOrFail();

        if (! $url->is_active) {

            abort(
                410,
                'This link has been disabled.'
            );
        }

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

        if ($url->password) {

            $unlockedVersion = session(
                "unlocked_url_{$url->id}"
            );

            if (
                $unlockedVersion !==
                $url->password_version
            ) {

                return redirect()->route(
                    'urls.unlock',
                    $url
                );
            }
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

    public function edit(Url $url)
    {
        abort_if(
            $url->user_id !== auth()->id(),
            403
        );

        return view(
            'urls.edit',
            compact('url')
        );
    }

    public function update(Request $request, Url $url)
    {
        abort_if(
            $url->user_id !== auth()->id(),
            403
        );

        $request->validate([

            'original_url' => [
                'required',
                'url'
            ],

            'short_code' => [
                'nullable',
                'alpha_dash',
                'max:50',
                Rule::unique('urls')
                    ->ignore($url->id)
            ],

            'expires_at' => [
                'nullable',
                'date'
            ],
            'password' => [
                'nullable',
                'min:4',
                'max:16'
            ],

        ]);

        if ($request->remove_password) {
            $password = null;
            $password_version = $url->password_version++;
        } elseif ($request->filled('password')) {
            $password = Hash::make($request->password);
            $password_version = $url->password_version++;
        }else{
            $password = $url->password;
            $password_version = $url->password_version;
        }

        $url->update([
            'original_url' => $request->original_url,
            'short_code' => $request->short_code,
            'expires_at' =>  $request->expires_at,
            'password' =>  $password,
            'password_version' =>  $password_version,
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'URL updated successfully.'
            );
    }

    public function showPasswordForm(
        Url $url
    )
    {
        return view(
            'urls.password',
            compact('url')
        );
    }

    public function verifyPassword(
        Request $request,
        Url $url
    )
    {
        if (
            ! Hash::check(
                $request->password,
                $url->password
            )
        ) {

            return back()->withErrors([

                'password' =>
                    'Incorrect password.'

            ]);
        }

        session()->put(
            "unlocked_url_{$url->id}",
            $url->password_version
        );

        return redirect(
            '/'.$url->short_code
        );
    }
}
