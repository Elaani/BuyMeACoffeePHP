<?php

declare(strict_types=1);

namespace BuyMeACoffee\Service;

use BuyMeACoffee\Model\User as UserModel;

// all clear
class User
{
    private const MINIMUM_PASSWORD = 5;
    private const MAXIMUM_EMAIL_LENGTH = 100;

    private const PASSWORD_COST_FACTOR = 12;
    private const PASSWORD_ALGORITHM = PASSWORD_BCRYPT;

    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function create(array $userDetails): string|bool
    {
        return $this->userModel->insert($userDetails);
    }

    public function doesAccountExist(string $email): bool
    {
        return $this->userModel->doesAccountExist($email);
    }

    public function isEmailValid(string $email): bool
    {
        return
            strlen($email) <= self::MAXIMUM_EMAIL_LENGTH &&
            filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function isPasswordValid(string $password): bool
    {
        return strlen($password) > self::MINIMUM_PASSWORD;
    }

    public function hashPassword(string $password): string
    {
        return (string) password_hash($password, self::PASSWORD_ALGORITHM, ['cost' => self::PASSWORD_COST_FACTOR]);
    }

    public function verifyPassword(string $clearedPassword, string $hashedPassword): bool
    {
        return password_verify($clearedPassword, $hashedPassword);
    }

    public function getUserDetails(string $email)
    {
        return $this->userModel->getUserDetails($email);
    }
}