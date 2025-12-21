<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RestoreToken;

class RestoreJob extends Model
{
    protected $table = 'restore_jobs';

    protected $fillable = [
        'user_id',
        'token_id',
        'status',
        'restore_type',
        'files_to_restore',
        'archive_name',
        'restore_path',
        'database_name',
        'selected_tables',
        'log_output',
    ];

    protected $casts = [
        'files_to_restore' => 'array',
        'selected_tables' => 'array',
    ];

    public function token()
    {
        return $this->belongsTo(RestoreToken::class, 'token_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
