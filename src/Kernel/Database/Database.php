<?php

namespace BuyMeACoffee\Kernel\Database;

use PDO;
use PDOException;
use PDOStatement;

class Database {
    private static ?PDO $db;
    private static ?PDOStatement $statement;

    public static function connect(array $dbDetatils): void {
        try {
            static::$pdo = new PDO(
                "mysql:host={$_ENV['DB_HOST']};dbname=){$_ENV['DB_NAME']}",
                 $_ENV['DB_USER'],
                 $_ENV['DB_PASSWORD']
            );
        } catch(PDOException $except) {
            exit('An unexpected database error has occurred.');
        }
    }

    // Prepare a query and execute if applicable
    public static function query(string $sql, array $binds, bool $execute = true): bool {
        static::$statement = static::$pdo->prepare($sql);

        foreach($binds as $key => $value) {
            static::$statement->bindValue($key, $value);
        }

        if ($execute) {
            static::$statement->execute();
        }

        return true;
    }

    public static function rowCount(): int {
        return static::$statement->rowCount();
    }

    public static function fetch() {
        return static::$statement->fetch();
    }

    public static function fetchAll(): ?array {
        return static::$statement->fetchAll() ?? null;
    }

    public static function quote(string $string): string {
        return static::$db->quote($string);
    }
}