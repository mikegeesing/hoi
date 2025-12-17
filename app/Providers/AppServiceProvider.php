<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind BorgWrapperService with repository path and passphrase from config/env
        $this->app->singleton(\App\Services\BorgWrapperService::class, function ($app) {
            $repo = config('services.borg.repository') ?? env('BORG_REPOSITORY');
            $pass = config('services.borg.passphrase') ?? env('BORG_PASSPHRASE');

            if (empty($repo) || empty($pass)) {
                // Let developers see a clear error during resolution
                throw new \RuntimeException('BorgWrapperService requires BORG_REPOSITORY and BORG_PASSPHRASE to be set.');
            }

            return new \App\Services\BorgWrapperService($repo, $pass);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
