<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlClick extends Model
{
    protected $fillable = [
        'url_id',
        'ip_address',
        'user_agent',
        'referer',
        'browser',
        'platform',
        'device_type',
    ];

    public function url()
    {
        return $this->belongsTo(Url::class);
    }
}
