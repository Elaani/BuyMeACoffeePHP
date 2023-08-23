<?php

namespace BuyMeACoffee\Service;

final class User {
    private const MINIMUM_PASSWORD = 5;
    private const MAXIMUM_EMAIL_LENGTH = 100; 

    public function isEmailValid(string $email): bool {
        return 
            strlen($email) <= self::MAXIMUM_EMAIL_LENGTH && 
            filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function isPasswordValid(string $password): bool {
        return strlen($password) > self::MINIMUM_PASSWORD;
    }
}