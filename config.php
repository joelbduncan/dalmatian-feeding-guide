<?php

// Site settings. Nothing in here is secret, so it's safe to commit.
// Passwords and server-specific settings go in config.local.php, which is
// not committed (copy config.local.example.php to get started).

$config = [
    'name'        => 'Dalmatian Feeding Guide',
    'tagline'     => 'Low-purine feeding for happy, healthy Dalmatians',
    'url'         => 'https://dalmatiandiet.org',
    'description' => 'Free, community-driven guide to feeding Dalmatians a low-purine diet to help prevent urate stones.',

    // Leave empty to turn a feature off.
    'plausible_domain' => 'dalmatiandiet.org',
    'plausible_script' => 'https://plausible.joelduncan.io/js/plausible.js',
    'buymeacoffee'     => 'joelbduncan',

    'author'     => 'Joel Duncan',
    'author_url' => 'https://joelduncan.io',

    // Main navigation. `path` is the URL; `children` become a sub-menu.
    'nav' => [
        ['label' => 'Home', 'path' => '/'],
        ['label' => 'Guides', 'children' => [
            ['label' => 'Three Rules', 'path' => '/three-rules'],
            ['label' => 'Purine Table', 'path' => '/purine-guide'],
            ['label' => 'Advanced Purine Table', 'path' => '/advanced-purine-guide'],
            ['label' => 'Dry Food', 'path' => '/dry-food-guide'],
            ['label' => 'Treats & Dangerous Foods', 'path' => '/treats'],
            ['label' => 'Water & Urine pH', 'path' => '/water-and-urine'],
        ]],
        ['label' => 'Health', 'children' => [
            ['label' => 'Warning Signs', 'path' => '/warning-signs'],
            ['label' => 'DNA Testing & LUA', 'path' => '/dna-testing'],
        ]],
        ['label' => 'FAQ', 'path' => '/faq'],
        ['label' => 'About', 'path' => '/about'],
        ['label' => 'Friends', 'path' => '/friends'],
        ['label' => 'Contact', 'path' => '/contact'],
    ],

    'useful_links' => [
        ['label' => 'Dalmatian Welfare', 'url' => 'http://www.dalmatianwelfare.co.uk/'],
    ],

    // Contact form. Set these in config.local.php; the form stays hidden
    // until the SMTP host, from_email and contact "to" address are filled in.
    'contact' => [
        'to'             => '',                          // where messages are delivered
        'subject_prefix' => '[Dalmatian Feeding Guide]',
    ],
    'smtp' => [
        'host'        => '',
        'port'        => 587,
        'encryption'  => 'tls',                          // "tls" (STARTTLS, port 587), "ssl" (port 465) or "none"
        'username'    => '',
        'password'    => '',
        'from_email'  => '',                             // usually the same as username
        'from_name'   => 'Dalmatian Feeding Guide',
        'timeout'     => 15,
        'verify_peer' => true,
    ],
];

$local = __DIR__ . '/config.local.php';

return is_file($local) ? array_replace_recursive($config, require $local) : $config;
