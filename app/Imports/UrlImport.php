<?php

namespace App\Imports;

use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UrlImport implements ToCollection, WithHeadingRow
{
    protected int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (
                empty($row['original_url'])
            ) {
                continue;
            }

            $shortCode = !empty($row['short_code'])
                ? trim($row['short_code'])
                : Str::random(6);

            if (
                Url::where('short_code', $shortCode)->exists()
            ) {
                continue;
            }

            $expiresAt = null;

            if (!empty($row['expires_at'])) {

                try {

                    $expiresAt = Carbon::parse(
                        $row['expires_at']
                    );

                } catch (\Exception $e) {

                    $expiresAt = null;
                }
            }

            Url::create([
                'user_id' =>  $this->userId,
                'original_url' => trim( $row['original_url']),
                'short_code' => $shortCode,
                'expires_at' =>  $expireAt,
            ]);
        }
    }
}