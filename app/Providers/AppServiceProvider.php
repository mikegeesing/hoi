<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind BorgWrapperService with repository path and passphrase from config/env
        $this->app->singleton(\App\Services\BorgWrapperService::class, function ($app) {
            $repo = config('services.borg.repository', env('BORG_REPOSITORY', '/backups'));
            $pass = config('services.borg.passphrase', env('BORG_PASSPHRASE', ''));

            if (empty($repo)) {
                Log::warning('BorgWrapperService: BORG_REPOSITORY not set, using /backups');
                $repo = '/backups';
            }

            if (empty($pass)) {
                Log::warning('BorgWrapperService: BORG_PASSPHRASE is empty. Borg commands may fail.');
            }

            return new \App\Services\BorgWrapperService($repo, $pass);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register event listener for login
        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Login::class,
            \App\Listeners\LogSuccessfulLogin::class
        );
    }
}
