<?php

declare(strict_types=1);

// Front controller: every page request comes through here.

// When using PHP's built-in server, let it serve real files (CSS, images…).
if (PHP_SAPI === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/lib/Content.php';
require APP_ROOT . '/lib/helpers.php';
require APP_ROOT . '/lib/ContactForm.php';

$site = require APP_ROOT . '/config.php';
$content = new Content(APP_ROOT . '/content');

// URL slug => template name. Each slug also has content/pages/<slug>.md
// (the home page uses home.md).
$routes = [
    ''                      => 'home',
    'three-rules'           => 'rules',
    'purine-guide'          => 'purine',
    'advanced-purine-guide' => 'advanced-purine',
    'dry-food-guide'        => 'dry-food',
    'treats'                => 'page',
    'water-and-urine'       => 'page',
    'warning-signs'         => 'page',
    'dna-testing'           => 'page',
    'faq'                   => 'faq',
    'about'                 => 'about',
    'friends'               => 'friends',
    'contact'               => 'contact',
];

// Old URLs that should permanently redirect.
$aliases = [
    'index'    => '',
    'dry-food' => 'dry-food-guide',
];

$path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
$slug = preg_replace('/\.php$/', '', $path);
$slug = $aliases[$slug] ?? $slug;

if ($slug !== $path) {
    header('Location: /' . $slug, true, 301);
    exit;
}

if (!isset($routes[$slug])) {
    http_response_code(404);
    render('404', ['site' => $site, 'content' => $content, 'slug' => $slug, 'page' => null]);
    exit;
}

$page = $content->page($slug === '' ? 'home' : $slug);

// Contact form: handle submissions, then redirect so a refresh can't resend.
$form = null;
if ($slug === 'contact' && ContactForm::isConfigured($site)) {
    $form = new ContactForm($site);
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
        if ($form->handle($_POST)) {
            header('Location: /contact', true, 303);
            exit;
        }
        http_response_code(422);
    } else {
        $form->pullFlash();
    }
}

render($routes[$slug], [
    'site'    => $site,
    'content' => $content,
    'slug'    => $slug,
    'page'    => $page,
    'form'    => $form,
]);
