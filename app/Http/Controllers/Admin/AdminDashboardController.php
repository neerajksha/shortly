<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Url;
use App\Models\UrlClick;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard',
            [
                'topUrls' => Url::select( 'short_code','clicks')->orderByDesc('clicks')->take(5)->get(),

                'topUsers' => User::withCount('urls')->orderByDesc('urls_count')->take(5)->get(),

                'topBrowsers' => UrlClick::select('browser',
                                    DB::raw('COUNT(*) as total')
                                )
                                ->groupBy('browser')
                                ->orderByDesc('total')
                                ->take(5)
                                ->get(),

                'topReferrers' => UrlClick::select(
                                    'referer',
                                    DB::raw('COUNT(*) as total')
                                )
                                ->whereNotNull('referer')
                                ->groupBy('referer')
                                ->orderByDesc('total')
                                ->take(5)
                                ->get(),
                
                'clicksLast30Days' => UrlClick::select(
                                        DB::raw('DATE(created_at) as day'),
                                        DB::raw('COUNT(*) as total')
                                    )
                                    ->where(
                                        'created_at',
                                        '>=',
                                        now()->subDays(30)
                                    )
                                    ->groupBy('day')
                                    ->orderBy('day')
                                    ->get(),


                'usersCount' => User::count(),

                'urlsCount' => Url::count(),

                'clicksCount' => UrlClick::count(),

                'activeUrls' => Url::where(function ($query) {

                    $query->whereNull('expires_at')->orWhere('expires_at','>',now());

                })->count(),

            ]
        );
    }
}
