<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminTokenPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestoreController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Laragear\WebAuthn\Http\Routes as WebAuthnRoutes;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// WebAuthn routes for passkeys
WebAuthnRoutes::register()->withoutMiddleware(VerifyCsrfToken::class);

/*
|--------------------------------------------------------------------------
| Auth dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin (login + admin middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/tokens', [AdminTokenPageController::class, 'index']);
    Route::post('/tokens', [AdminTokenPageController::class, 'store']);
    Route::post('/tokens/{token}/revoke', [AdminTokenPageController::class, 'revoke']);
    Route::post('/tokens/{token}/regenerate', [AdminTokenPageController::class, 'regenerate']);

    // Redirect admin profile URL to the standard profile page
    Route::redirect('/profile', '/profile')->name('admin.profile');
});

// Profile routes for all authenticated users (admin & non-admin)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');
Route::delete('/profile/passkeys/{credentialId}', [ProfileController::class, 'destroyPasskey'])->name('profile.passkeys.destroy')->middleware('auth');

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
Route::get('/restore/api/tables', [RestoreController::class, 'apiSqlTables'])->name('restore.api.tables');

Route::get('/restore/mysql', [RestoreController::class, 'showMySQLRestore'])->name('restore.mysql');
Route::post('/restore/mysql/confirm', [RestoreController::class, 'confirmMySQLRestore'])->name('restore.mysql-confirm');

Route::get('/restore/website', [RestoreController::class, 'showWebsiteRestore'])->name('restore.website');
Route::post('/restore/website/confirm', [RestoreController::class, 'confirmWebsiteRestore'])->name('restore.website-confirm');



/*
|--------------------------------------------------------------------------
| Auth routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
