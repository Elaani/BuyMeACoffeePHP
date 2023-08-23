<?php

declare(strict_types=1);

namespace BuyMeACoffee\Controller;

use BuyMeACoffee\Kernel\PhpTemplate\View;
use BuyMeACoffee\Kernel\Input;
use BuyMeACoffee\Service\User as UserService;

class Account
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function signup(): void
    {
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
                    if ($this->userService->doesAccountExist($email)) {
                        $viewVariables[View::ERROR_MESSAGE_KEY] = 'An account with the same email already exists.';
                    }
                    $user = [
                        'fullname' => $fullName,
                        'email' => $email,
                        'password' => $password
                    ];

                    if ($this->userService->create($user)) {
                        // Register the user
                        redirect('/home');
                    } else {
                        $viewVariables[View::ERROR_MESSAGE_KEY] = 'An error has occurred while creating your account. Please try again.';
                    }
                } else {
                    $viewVariables[View::ERROR_MESSAGE_KEY] = 'Email/Password is not valid.';
                }
            } else {
                $viewVariables[View::ERROR_MESSAGE_KEY] = 'All fields are required.';
            }
        }

        View::render('account/signup', 'Sign Up', $viewVariables);
    }

    public function signin(): void
    {
        View::render('account/signin', 'Sign In');
    }
    public function edit(): void
    {
        View::render('account/edit', 'Edit Account');
    }

}