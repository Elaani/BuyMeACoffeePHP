<?php

declare(strict_types=1);

namespace BuyMeACoffee\Controller;

use BuyMeACoffee\Kernel\Input;
use BuyMeACoffee\Kernel\PhpTemplate\View;
use BuyMeACoffee\Kernel\Session;
use BuyMeACoffee\Service\User as UserService;
use BuyMeACoffee\Service\UserSession as UserSessionService;

use BuyMeACoffee\Service\UserSession;

class Account
{
    private UserService $userService;
    private UserSessionService $userSessionService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->userSessionService = new UserSessionService(new Session());
    }

    public function signUp(): void
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
                    } else {
                        $user = [
                            'fullname' => $fullName,
                            'email' => $email,
                            'password' => $this->userService->hashPassword($password)
                        ];

                        // Register the user
                        if ($userId = $this->userService->create($user)) {
                            $this->userSessionService->setAuthentication([
                                UserSession::USER_ID_SESSION_NAME => $userId,
                                'email' => $email,
                                'fullName' => $fullName
                            ]);

                            redirect();
                        } else {
                            $viewVariables[View::ERROR_MESSAGE_KEY] = 'An error has occurred while creating your account. Please try again.';
                        }
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

    public function signIn(): void
    {
        View::render('account/signin', 'Sign In');
    }
    public function edit(): void
    {
        View::render('account/edit', 'Edit Account');
    }

    public function logOut(): void
    {
        $this->userSessionService->logout();

        // Redirect the user to the index page
        redirect();
    }
}