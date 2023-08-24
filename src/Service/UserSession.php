<?php

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

    public function setAuthentication(array $userDetails)
    {
        $this->session->sets($userDetails);
    }

    public function logout()
    {
        $this->session->destroy();
    }

    public function getName(): string
    {
        return $this->session->get('fullName');
    }
}