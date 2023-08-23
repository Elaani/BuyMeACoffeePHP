<?php

namespace BuyMeACoffee;

use BuyMeACoffee\Kernel\Http\Router;
use BuyMeACoffee\Kernel\PhpTemplate\ViewNotFound;

try {
    Router::get('/', 'Homepage@index');
    Router::get('/about', 'Homepage@about');
    Router::get('/contact', '/?uri=about'); // Redirect to /about page
    
    Router::get('/signup', 'Account@signup');
    Router::get('/signin', 'Account@signin');
    Router::get('/account/edit', 'Account@edit');

    Router::get('/payment', 'Payment@payment');
} catch (ViewNotFound $err) {
    echo $err->getMessage();
}