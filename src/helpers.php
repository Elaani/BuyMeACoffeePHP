<?php

declare(strict_types=1);

function site_url(string $value = '') {
    // Guard clause
    if (!empty($value)) {
        return $_ENV['SITE_URL'] . $value;
    }

    return $_ENV['SITE_URL'];
};