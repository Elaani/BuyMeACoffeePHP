<?php

namespace BuyMeACoffee\Controller;

use BuyMeACoffee\Kernel\PhpTemplate\View;

class Account {
    public function signup(): void {
        // if () {

        // }

        View::render('account/signup', 'Sign Up');
    }

    public function signin(): void {
        View::render('account/signin', 'Sign In');
    }
    public function edit(): void {
        View::render('account/edit', 'Edit Account');
    }
    
}