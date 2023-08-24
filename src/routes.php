<?php

namespace BuyMeACoffee;

use BuyMeACoffee\Kernel\Http\Router;
use BuyMeACoffee\Kernel\PhpTemplate\ViewNotFound;

try {
    Router::get('/', 'Homepage@index');
    Router::get('/about', 'Homepage@about');
    Router::get('/contact', '/?uri=about'); // Redirect to /about page

    Router::getAndPost('/signup', 'Account@signUp');
    Router::getAndPost('/signin', 'Account@signIn');
    Router::getAndPost('/account/edit', 'Account@edit');

    Router::getAndPost('/payment', 'Payment@payment');
} catch (ViewNotFound $err) {
    echo $err->getMessage();
}