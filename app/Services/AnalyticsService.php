<?php

namespace App\Services;

use App\Models\Url;
use App\Models\UrlClick;
use hisorange\BrowserDetect\Parser as Browser;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class AnalyticsService
{
    public static function track(Url $url): void
    {
        $url->increment('clicks');

        $crawler = new CrawlerDetect();

        if ($crawler->isCrawler()) {
            return;
        }

        UrlClick::create([
            'url_id'      => $url->id,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
            'referer'     => request()->header('referer'),
            'browser'     => Browser::browserName(),
            'platform'    => Browser::platformName(),
            'device_type' => self::deviceType(),
        ]);
    }

    private static function deviceType(): string
    {
        if (Browser::isMobile()) {
            return 'Mobile';
        }

        if (Browser::isTablet()) {
            return 'Tablet';
        }

        return 'Desktop';
    }
}