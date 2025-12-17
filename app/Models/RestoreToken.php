<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestoreToken extends Model
{
    protected $fillable = [
        'token',
        'borg_user',
        'expires_at',
        'max_uses',
        'used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

}
