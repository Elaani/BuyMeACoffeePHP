<?php

namespace BuyMeACoffee;

use BuyMeACoffee\Kernel\Http\Router;
use BuyMeACoffee\Kernel\Session;
use BuyMeACoffee\Service\UserSession as UserSessionService;
use Exception;

$userSession = new UserSessionService(new Session());

try {
    Router::get('/', 'Homepage@index');
    Router::get('/about', 'Homepage@about');
    Router::getAndPost('/contact', 'Homepage@contact');

    if (! $userSession->isLoggedIn()) {
        Router::getAndPost('/signup', 'Account@signUp');
        Router::getAndPost('/signin', 'Account@signIn');
    }

    if ($userSession->isLoggedIn()) {
        Router::getAndPost('/account/edit', 'Account@edit');
        Router::getAndPost('/account/password', 'Account@password');
        Router::getAndPost('/payment', 'Payment@payment');
        Router::getAndPost('/item', 'Payment@item');
        Router::get('/showitem', 'Payment@showItem');
        Router::get('/account/logout', 'Account@logout');
    }

    Router::end();
} catch (Exception $err) {
    echo $err->getMessage();
}