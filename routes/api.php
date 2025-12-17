<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TokenController;

Route::post('/admin/token/create', [TokenController::class, 'store']);
