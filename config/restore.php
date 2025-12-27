<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Login Rate Limit
    |--------------------------------------------------------------------------
    |
    | The number of login attempts allowed per minute for the restore token
    | login page. This is used to prevent brute-force attacks.
    |
    */

    'login_rate_limit' => env('RESTORE_LOGIN_RATE_LIMIT', 10),

    /*
    |--------------------------------------------------------------------------
    | Available Domains
    |--------------------------------------------------------------------------
    |
    | List of domains available for website restore.
    | You can override via env RESTORE_DOMAINS=domain1.com,domain2.com
    |
    */
    
    'domains' => explode(',', env('RESTORE_DOMAINS', '')),

    /*
    |--------------------------------------------------------------------------
    | DirectAdmin Integration (optional)
    |--------------------------------------------------------------------------
    |
    | To auto-fetch domains from DirectAdmin:
    | Set DIRECTADMIN_ENABLED=true
    | Set DIRECTADMIN_HOST=your-da-server.com
    | Set DIRECTADMIN_USER and DIRECTADMIN_PASS
    |
    */

    'directadmin' => [
        'enabled' => env('DIRECTADMIN_ENABLED', false),
        'host' => env('DIRECTADMIN_HOST'),
        'user' => env('DIRECTADMIN_USER'),
        'pass' => env('DIRECTADMIN_PASS'),
    ],
];
