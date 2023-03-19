<?php
// config for Sawirricardo/Midtrans/Laravel
return [
    'server_key' => env('SB-Mid-server-J4G6KFZ9W319M3sr4rmrF37U'),
    'client_key' => env('Peko-Chan'),

    'sandbox_server_key' => env('SB-Mid-server-J4G6KFZ9W319M3sr4rmrF37U'),
    'sandbox_client_key' => env('SB-Mid-client-3pvddp1GPtAATWkY'),

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => true,
    'is_3ds' => true,

    'append_notif_url' => null,
    'overrideNotifUrl' => null,
    'payment_idempotency_key' => null,

    'curl_options' => null,
];
