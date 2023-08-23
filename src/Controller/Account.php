<?php

declare(strict_types=1);

namespace BuyMeACoffee\Controller;

use BuyMeACoffee\Kernel\PhpTemplate\View;
use BuyMeACoffee\Kernel\Input;
use BuyMeACoffee\Service\User as UserService;


class Account {
    public function __construct(private UserService $userService = new UserService()) {
    }

    public function signup(): void {
        $viewVariables = [];

        if (Input::post('signup_submit')) {
            // Treat the values we recieve

            $fullName = Input::post('fullname');
            $email = Input::post('email');
            $password = Input::post('password');

            if (isset($fullName, $email, $password)) {
                if (
                    $this->userService->isEmailValid($email) && 
                    $this->userService->isPasswordValid($password)
                ) {
                    // Register the user
                    redirect('/?uri=home');
                } else {
                    $viewVariables[View::ERROR_MESSAGE_KEY] = 'Email/Password is not valid.';
                }
            } else {
                $viewVariables[View::ERROR_MESSAGE_KEY] = 'All fields are required.';
            }
        };

        View::render('account/signup', 'Sign Up', $viewVariables);
    }

    public function signin(): void {
        View::render('account/signin', 'Sign In');
    }
    public function edit(): void {
        View::render('account/edit', 'Edit Account');
    }

}