<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function data()
    {
        $query = User::where('is_admin', false)
            ->withCount('urls');

        return DataTables::eloquent($query)

            ->addColumn('actions', function ($user) {

                return view(
                    'admin.users.actions',
                    compact('user')
                )->render();
            })

            ->addColumn('status', function ($user) {

                return $user->is_active

                    ? '<span class="badge bg-success">Active</span>'

                    : '<span class="badge bg-danger">Suspended</span>';
            })

            ->rawColumns([
                'status',
                'actions'
            ])

            ->make(true);
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {

            return back()->with(
                'error',
                'You cannot suspend yourself.'
            );
        }

        $user->update([
            'is_active' => ! $user->is_active
        ]);

        return back()->with(
            'success',
            $user->is_active
                ? 'User activated.'
                : 'User suspended.'
        );
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {

            return back()->with(
                'error',
                'You cannot delete yourself.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'User deleted.'
        );
    }

    public function show(User $user)
    {
        $user->loadCount('urls');

        $totalClicks = $user->urls()->sum('clicks');

        $activeUrls = $user
            ->urls()
            ->where(function ($query) {

                $query
                    ->whereNull('expires_at')
                    ->orWhere(
                        'expires_at',
                        '>',
                        now()
                    );

            })
            ->count();

        return view(
            'admin.users.show',
            compact(
                'user',
                'totalClicks',
                'activeUrls'
            )
        );
    }

    public function userUrlsData(User $user)
    {
        return DataTables::eloquent(

            $user->urls()->latest()

        )
        ->editColumn('created_at', function ($url) {

            return $url->created_at
                ->format('d M Y h:i A');
        })
        ->addColumn('short_url', function ($url) {

            return sprintf(
                '<a href="%s" target="_blank">%s</a>',
                url($url->short_code),
                $url->short_code
            );
        })

        ->rawColumns(['short_url','created_at'])

        ->make(true);
    }
}
