<?php

declare(strict_types=1);

namespace BuyMeACoffee\Service;

use BuyMeACoffee\Kernel\Session;

class UserSession
{
    public const USER_ID_SESSION_NAME = 'userId';

    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function isLoggedIn(): bool
    {
        return $this->session->doesExist(self::USER_ID_SESSION_NAME);
    }

    public function setAuthentication(string|int $userId, string $email, string $fullName)
    {
        $this->session->sets(
            [
                self::USER_ID_SESSION_NAME => $userId,
                'email' => $email,
                'fullName' => $fullName,
            ]
        );
    }

    public function logout()
    {
        $this->session->destroy();
    }

    public function getName(): string
    {
        return $this->session->get('fullName');
    }

    public function getId(): string
    {
        return $this->session->get(self::USER_ID_SESSION_NAME);
    }
}