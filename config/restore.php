<?php

return [
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
