<?php

return [
    // Enforce passkey-only authentication (disable password login & self-registration)
    'only' => (bool) env('WEBAUTHN_ONLY', false),
    // Relying Party ID must match the effective domain serving the app.
    'rp' => [
        'id' => env('WEBAUTHN_RP_ID', parse_url(env('APP_URL', 'https://restore.onlinehoster.nl'), PHP_URL_HOST)),
        'name' => env('APP_NAME', 'Online Hoster Restore'),
        'icon' => null,
        'origins' => [
            env('WEBAUTHN_ORIGIN', env('APP_URL', 'https://restore.onlinehoster.nl')),
        ],
    ],

    // Authentication options
    'auth' => [
        'user_verification' => 'preferred',
    ],

    // Registration options
    'register' => [
        'user_verification' => 'preferred',
    ],

    // Timeout (ms)
    'timeout' => 60000,
];
