<?php
declare(strict_types=1);

/**
 * PHP built-in server router — clean URLs (matches .htaccess).
 * Run: php -S 127.0.0.1:8080 router.php
 */
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');
$file = __DIR__ . $uri;

if ($uri !== '/' && is_file($file)) {
    return false;
}

if (preg_match('/\.php$/i', $uri)) {
    $clean = preg_replace('/\.php$/i', '', $uri) ?: '/';
    if ($clean === '/index') {
        $clean = '/';
    }
    header('Location: ' . $clean, true, 301);
    exit;
}

$slug = trim($uri, '/');
if ($slug === '' || $slug === 'index') {
    require __DIR__ . '/index.php';
    return true;
}

$candidate = __DIR__ . '/' . $slug . '.php';
if (is_file($candidate)) {
    require $candidate;
    return true;
}

http_response_code(404);
echo '404 Not Found';
return true;
