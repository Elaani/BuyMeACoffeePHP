<?php

declare(strict_types=1);

namespace BuyMeACoffee\Model;

use BuyMeACoffee\Kernel\Database\Database;

class User
{
    private const MINIMUM_PASSWORD = 5;
    private const TABLE_NAME = 'users';

    public function insert(array $userDetails): string|bool
    {
        $sql = 'INSERT INTO ' . self::TABLE_NAME . ' (fullname, email, password) VALUES(:fullname, :email, :password)';

        if (Database::query($sql, $userDetails)) {
            return Database::lastInsertId();
        }

        return false;
    }

    public function doesAccountEmailExist(string $email): bool
    {
        $sql = 'SELECT email FROM ' . self::TABLE_NAME . ' WHERE email = :email LIMIT 1';

        Database::query($sql, ['email' => $email]);

        // We check if the query returned one or one email addresses
        return Database::rowCount() >= 1;
    }

    public function getUserDetails(string $email)
    {
        $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE email = :email LIMIT 1';
        Database::query($sql, ['email' => $email]);

        return Database::fetch();
    }
}