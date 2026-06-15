<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'user_id',
        'original_url',
        'short_code',
        'clicks',
        'expires_at',
        'is_active',
        'password'
    ];

    protected $hidden = [
        'password',
    ];
    
    protected $appends = [
        'is_password_protected',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clicksData()
    {
        return $this->hasMany(UrlClick::class);
    }

    public function getIsPasswordProtectedAttribute(): bool
    {
        return ! is_null($this->password);
    }
}
