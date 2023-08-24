<?php

declare(strict_types=1);

namespace BuyMeACoffee\Kernel;

class Session
{
    public function __contruct()
    {
        $this->initialize();
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function sets(array $data): void
    {
        // ----------- v
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function doesExist(string $key): bool
    {
        return ! empty($_SESSION[$key]);
    }

    public function destroy(): void
    {
        if (! empty($_SESSION)) {
            $_SESSION = [];
            session_unset();
            session_destroy();
        }
    }

    private function isActivated(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    private function initialize()
    //------------------^
    {
        if (! $this->isActivated()) {
            session_start();
        }
    }
}