<?php

declare(strict_types=1);
//all clear
namespace BuyMeACoffee\Kernel;

final class Input
{
    public static function get(string $key): null|string|array
    {
        echo "get";
        return $_GET[$key] ?? '';
    }

    public static function post(string $key): null|string|array
    {
        echo "post";
        return $_POST[$key] ?? '';
    }

    public static function postExists(string $key): bool
    {
        echo "post exists";
        return ! empty($_POST[$key]);
    }

    public static function getExists(string $key): bool
    {
        echo "get exists";
        return ! empty($_GET[$key]);
    }
}