<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestoreJob;

class RestoreJobController extends Controller
{
    public function show(RestoreJob $job)
    {
        return view('admin.restore.job', ['job' => $job]);
    }
}
