<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IMAP Credentials
    |--------------------------------------------------------------------------
    |
    | Credentials for getting warnings by email via IMAP.
    |
    */

    'server' => env('IMAP_SERVER'),
    'port' => env('IMAP_PORT'),
    'user' => env('IMAP_USER'),
    'password' => env('IMAP_PASSWORD'),

];
