<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminTokenPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestoreController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin (login + admin middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/tokens', [AdminTokenPageController::class, 'index']);
    Route::post('/tokens', [AdminTokenPageController::class, 'store']);
    Route::post('/tokens/{token}/revoke', [AdminTokenPageController::class, 'revoke']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin restore job pages
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/restore/jobs/{job}', [\App\Http\Controllers\Admin\RestoreJobController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| Restore portal (TOKEN based, GEEN auth)
|--------------------------------------------------------------------------
*/

Route::get('/restore', [RestoreController::class, 'showLogin'])
    ->name('restore.login');

Route::get('/restore/archives', [RestoreController::class, 'showArchives'])
    ->name('restore.archives');

Route::get('/restore/files/{archive}', [RestoreController::class, 'showFiles'])
    ->name('restore.files');

Route::post('/restore/start', [RestoreController::class, 'startRestore'])
    ->name('restore.start');

Route::get('/restore/status/{job}', [RestoreController::class, 'getJobStatus'])
    ->name('restore.status');

Route::get('/restore/calendar', [RestoreController::class, 'showCalendar'])->name('restore.calendar');
Route::get('/restore/api/snapshots', [RestoreController::class, 'apiSnapshots'])->name('restore.api.snapshots');



/*
|--------------------------------------------------------------------------
| Auth routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
