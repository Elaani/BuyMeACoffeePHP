<?php

declare(strict_types=1);

function site_url(string $value = '') {
    // Guard clause
    if (!empty($value)) {
        return $_ENV['SITE_URL'] . $value;
    }

    return $_ENV['SITE_URL'];
};

function redirect(string $value, $permanent = true): void {

    if ($permanent) { // Good for Search Engine Optimization
        header('HTTP/1.1 301 Moved Permanently');
    }

    if (!empty($value)) {
        $url = str_contains($value, 'http') ? $value : $_ENV['SITE_URL'] . $value;
    } else {
        $url = $_ENV['SITE_URL'];
    }

    header('Location: ' . $url);
    exit;
};