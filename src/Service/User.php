<?php

namespace BuyMeACoffee\Service;

final class User {
    private const MINIMUM_PASSWORD = 5;

    public function isEmailValid(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function isPasswordValid(string $password): bool {
        return strlen($password) > self::MINIMUM_PASSWORD;
    }
}