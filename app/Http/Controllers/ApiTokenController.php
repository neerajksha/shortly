<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ApiTokenController extends Controller
{
    public function index()
    {
        $tokens = auth()
            ->user()
            ->tokens()
            ->latest()
            ->get();

        return view(
            'api-tokens.index',
            compact('tokens')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => [
                'required'
            ]

        ]);

        $token = auth()
            ->user()
            ->createToken(
                $request->name
            );

        return back()->with(
            'plainTextToken',
            $token->plainTextToken
        );
    }

    public function destroy(
        PersonalAccessToken $token
    )
    {
        abort_if(

            $token->tokenable_id !== auth()->id(),

            403

        );

        $token->delete();

        return back()->with(
            'success',
            'Token revoked successfully.'
        );
    }
}