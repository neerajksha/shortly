<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class UrlTemplateExport implements FromArray
{
    public function array(): array
    {
        return [

            [
                'original_url',
                'short_code',
                'expires_at'
            ],

            [
                'https://google.com',
                'google',
                ''
            ],

            [
                'https://github.com',
                'github',
                ''
            ],

        ];
    }
}