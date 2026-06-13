<?php

namespace App\Http\Controllers;
use App\Models\Url;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function show(Url $url)
    {
        if ($url->user_id !== auth()->id()) {
            abort(403);
        }

        $renderer = new ImageRenderer(
            new RendererStyle(300),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        $svg = $writer->writeString(
            url($url->short_code)
        );

        return response($svg)
            ->header(
                'Content-Type',
                'image/svg+xml'
            );
    }

    public function download(Url $url)
    {
        $qr = QrCode::format('png')
            ->size(500)
            ->generate(
                url($url->short_code)
            );

        return response($qr)
            ->header(
                'Content-Type',
                'image/png'
            )
            ->header(
                'Content-Disposition',
                'attachment; filename="qr-code.png"'
            );
    }

    public function downloadQr(Url $url)
    {
        if ($url->user_id !== auth()->id()) {
            abort(403);
        }

        $renderer = new ImageRenderer(
            new RendererStyle(500),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        $svg = $writer->writeString(
            url($url->short_code)
        );

        return response($svg)
            ->header(
                'Content-Type',
                'image/svg+xml'
            )
            ->header(
                'Content-Disposition',
                'attachment; filename="qr-'.$url->short_code.'.svg"'
            );
    }
}
