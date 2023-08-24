<?php

declare(strict_types=1);

namespace BuyMeACoffee\Controller;

use BuyMeACoffee\Kernel\Session;
use BuyMeACoffee\Kernel\PhpTemplate\View;
use BuyMeACoffee\Service\UserSession as UserSessionService;

class Homepage
{
    //all clear
    private UserSessionService $userSessionService;
    private $isLoggedIn;

    public function __construct()
    {
        $session = new Session();
        $this->userSessionService = new UserSessionService($session);
        $this->isLoggedIn = $this->userSessionService->isLoggedIn();
    }

    public function index(): void
    {
        $viewVariables = ['isLoggedIn' => $this->isLoggedIn];

        if ($this->userSessionService->isLoggedIn()) {
            $viewVariables['name'] = $this->userSessionService->getName();
        }

        View::render('home/index', 'Homepage', $viewVariables);
    }

    public function about(): void
    {
        $viewVariables = [
            'isLoggedIn' => $this->isLoggedIn,
            'siteName' => $_ENV['SITE_NAME'], 
            'contactEmail' => $_ENV['ADMIN_EMAIL']
        ];

        View::render('home/about', 'About', $viewVariables);
    }
}