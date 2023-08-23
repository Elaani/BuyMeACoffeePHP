<?php

namespace BuyMeACoffee\Service;

use BuyMeACoffee\Model\User as UserModel;

class User
{
    private const MINIMUM_PASSWORD = 5;
    private const MAXIMUM_EMAIL_LENGTH = 100;

    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function create(array $userDetails): bool
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
}