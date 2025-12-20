<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestoreToken extends Model
{
    protected $fillable = [
        'token',
        'token_hash',
        'token_encrypted',
        'borg_user',
        'expires_at',
        'max_uses',
        'used',
        'last_used_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'last_used_at' => 'datetime',
    ];

}
