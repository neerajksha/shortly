<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        return view(
            'welcome',
            [

                'urlsCount' => Url::count(),

                'usersCount' => User::count(),

                'clicksCount' => Url::sum('clicks'),

            ]
        );
    }
}