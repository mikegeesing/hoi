<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\RestoreController;

Route::post('/admin/token/create', [TokenController::class, 'store']);
Route::post('/restore', [RestoreController::class, 'startRestore']);
