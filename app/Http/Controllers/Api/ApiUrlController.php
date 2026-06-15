<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ApiUrlController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $urls = $request->user()->urls()->latest()->paginate(10);

        return $this->success(
            $urls,
            'URLs fetched successfully'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => ['required','url'],
            'short_code' => ['nullable','alpha_dash','max:50','unique:urls,short_code'],
            'expires_at' => ['nullable','date','after:now'],
            'password' => ['nullable','min:4','max:16'],
        ]);

        // $url = Url::create([
        //     'user_id' => $request->user()->id,
        //     'original_url' => $request->url,
        //     'short_code' => Str::random(6),
        // ]);

        $url = Url::create([
            'user_id' => $request->user()->id,
            'original_url' => $request->url,
            'short_code' => $request->short_code ?? Str::random(6),
            'expires_at' => $request->expires_at ?? NULL,
            'password' => $request->password ? Hash::make($request->password) : NULL,
        ]);

        return $this->success(
            [
                'id' => $url->id,
                'short_code' => $url->short_code,
                'short_url' => url($url->short_code),
                'expires_at' => $url->expires_at
            ],
            'URL created successfully',
            201
        );
    }

    public function analytics( Request $request, Url $url)
    {
        abort_if(
            $url->user_id !== $request->user()->id,
            403
        );

        $uniqueVisitors = $url
            ->clicksData()
            ->distinct('ip_address')
            ->count('ip_address');

        $topBrowsers = $url
            ->clicksData()
            ->select(
                'browser',
                DB::raw(
                    'COUNT(*) as total'
                )
            )
            ->groupBy('browser')
            ->orderByDesc('total')
            ->get();

        $topPlatforms = $url
            ->clicksData()
            ->select(
                'platform',
                DB::raw(
                    'COUNT(*) as total'
                )
            )
            ->groupBy('platform')
            ->orderByDesc('total')
            ->get();
        
        return $this->success(
            [
                'id' => $url->id,
                'short_code' => $url->short_code,
                'short_url' => url($url->short_code),
                'original_url' => $url->original_url,
                'clicks' => $url->clicks,
                'unique_visitors' => $uniqueVisitors,
                'top_browsers' => $topBrowsers,
                'top_platforms' => $topPlatforms,
            ],
            'Analytics fetched successfully'
        );
    }

    public function clicks(Request $request, Url $url)
    {
        abort_if(
            $url->user_id !== $request->user()->id,
            403
        );

        $clicks = $url->clicksData()->latest()->paginate(25);

        return $this->success(
            $clicks,
            'Click logs fetched successfully'

        );
    }

    public function update( Request $request,Url $url)
    {
        abort_if(
            $url->user_id !== $request->user()->id,
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

                Rule::unique(
                    'urls',
                    'short_code'
                )->ignore(
                    $url->id
                )
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
            'remove_password' => [
                'nullable',
                'boolean'
            ]

        ]);
        
        if ($request->boolean('remove_password')) {
            $password = null;
            $password_version = $url->password_version++;
        }elseif ($request->password) {
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

        return $this->success(

            [

                'id' =>
                    $url->id,

                'short_code' =>
                    $url->short_code,

                'short_url' =>
                    url(
                        $url->short_code
                    ),

                'original_url' =>
                    $url->original_url,

                'expires_at' =>
                    $url->expires_at,

            ],

            'URL updated successfully'

        );
    }

    public function destroy(Request $request,Url $url)
    {
        abort_if(
            $url->user_id !== $request->user()->id,
            403
        );

        $url->delete();

        return $this->success(
            null,
            'URL deleted successfully'
        );
    }
}
