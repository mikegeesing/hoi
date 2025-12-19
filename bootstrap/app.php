<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAdminApiKey;
use App\Http\Middleware\RestoreToken;

return Application::configure(basePath: dirname(__DIR__))
 ->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',	
    )
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
  	'admin' => \App\Http\Middleware\EnsureAdmin::class,
        'auth.admin'   => CheckAdminApiKey::class,
        'restore.token'=> RestoreToken::class,
    ]);

    // Log all authenticated user activity
    $middleware->append(\App\Http\Middleware\LogActivity::class);

    // Allow WebAuthn endpoints without CSRF (publicly POSTed by JS)
    $middleware->validateCsrfTokens(except: [
        'webauthn/register/options',
        'webauthn/register',
        'webauthn/login/options',
        'webauthn/login',
    ]);
})


    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
