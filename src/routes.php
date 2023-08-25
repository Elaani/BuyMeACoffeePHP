<?php

namespace BuyMeACoffee;

use BuyMeACoffee\Kernel\Http\Router;
use BuyMeACoffee\Kernel\PhpTemplate\ViewNotFound;
use BuyMeACoffee\Kernel\Session;
use BuyMeACoffee\Service\UserSession as UserSessionService;

// all clear

$userSession = new UserSessionService(new Session());

try {
    Router::get('/', 'Homepage@index');
    Router::get('/about', 'Homepage@about');
    Router::get('/contact', '/about'); // Redirect to /about page

    if (! $userSession->isLoggedIn()) {
        Router::getAndPost('/signup', 'Account@signUp');
        Router::getAndPost('/signin', 'Account@signIn');
    }

    if ($userSession->isLoggedIn()) {
        Router::getAndPost('/account/edit', 'Account@edit');
        Router::getAndPost('/payment', 'Payment@payment');
        Router::get('/account/logout', 'Account@logout');
    }

} catch (ViewNotFound $err) {
    echo $err->getMessage();
}