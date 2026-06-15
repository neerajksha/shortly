<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use Yajra\DataTables\Facades\DataTables;

class AdminUrlController extends Controller
{
    public function index()
    {
        return view(
            'admin.urls.index'
        );
    }

    public function data()
    {
        return DataTables::eloquent(

            Url::with('user')

        )

        ->addColumn('owner', function ($url) {

            return $url->user->name;
        })

        ->addColumn('status', function ($url) {

            return $url->is_active

                ? '<span class="badge bg-success">Active</span>'

                : '<span class="badge bg-danger">Disabled</span>';
        })

        ->addColumn('actions', function ($url) {

            return view(
                'admin.urls.actions',
                compact('url')
            )->render();
        })

        ->editColumn('created_at', function ($url) {

            return $url->created_at
                ->format('d M Y');
        })

        ->rawColumns([
            'status',
            'actions'
        ])

        ->make(true);
    }

    public function toggleStatus(Url $url)
    {
        
        $url->update([
            'is_active' => ! $url->is_active
        ]);

        return back()->with(
            'success',
            $url->is_active
                ? 'URL activated.'
                : 'URL disabled.'
        );
    }

    public function analytics(Url $url)
    {
        $url->load('user');

        $uniqueVisitors = $url
            ->clicksData()
            ->distinct('ip_address')
            ->count('ip_address');

        return view(
            'admin.urls.analytics',
            compact(
                'url',
                'uniqueVisitors'
            )
        );
    }

    public function analyticsData(Url $url)
    {
        return DataTables::eloquent(

            $url->clicksData()->latest()

        )

        ->editColumn('referer', function ($click) {

            return $click->referer ?: 'Direct';
        })

        ->editColumn('created_at', function ($click) {

            return $click->created_at
                ->format('d M Y h:i A');
        })

        ->make(true);
    }
}
