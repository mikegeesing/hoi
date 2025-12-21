<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RestoreToken;

class RestoreJob extends Model
{
    protected $table = 'restore_jobs';

    protected $fillable = [
        'token_id',
        'status',
        'restore_type',
        'files_to_restore',
        'archive_name',
        'restore_path',
        'database_name',
        'log_output',
    ];

    protected $casts = [
        'files_to_restore' => 'array',
    ];

    public function token()
    {
        return $this->belongsTo(RestoreToken::class, 'token_id');
    }
}
