<?php

// Copy this file to config.local.php and fill in your details.
// config.local.php is git-ignored, so your password never ends up in the repo.

return [
    'contact' => [
        'to' => 'you@example.com',                 // where contact messages go
    ],
    'smtp' => [
        'host'       => 'smtp.example.com',
        'port'       => 587,
        'encryption' => 'tls',                     // "tls" for 587, "ssl" for 465
        'username'   => 'website@dalmatiandiet.org',
        'password'   => 'your-smtp-password',
        'from_email' => 'website@dalmatiandiet.org',
    ],
];
