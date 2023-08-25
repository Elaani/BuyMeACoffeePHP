<?php

declare(strict_types=1);

namespace BuyMeACoffee\Controller;

use BuyMeACoffee\Kernel\Input;
use BuyMeACoffee\Kernel\PhpTemplate\View;
use BuyMeACoffee\Kernel\Session;
use BuyMeACoffee\Service\User as UserService;
use BuyMeACoffee\Service\UserSession as UserSessionService;

class Account
{
    private UserService $userService;
    private UserSessionService $userSessionService;

    private bool $isLoggedIn;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->userSessionService = new UserSessionService(new Session());
        $this->isLoggedIn = $this->userSessionService->isLoggedIn();
    }

    public function signUp(): void
    {
        $viewVariables = [];

        if (Input::postExists('signup_submit')) {
            // Treat the values we recieve

            $fullName = Input::post('name');
            $email = Input::post('email');
            $password = Input::post('password');

            if (isset($fullName, $email, $password)) {
                if (
                    $this->userService->isEmailValid($email) &&
                    $this->userService->isPasswordValid($password)
                ) {
                    if ($this->userService->doesAccountEmailExist($email)) {
                        $viewVariables[View::ERROR_MESSAGE_KEY] = 'An account with the same email already exists.';
                    } else {
                        $user = [
                            'fullname' => $fullName,
                            'email' => $email,
                            'password' => $this->userService->hashPassword($password)
                        ];

                        // Register the user
                        if ($userId = $this->userService->create($user)) {
                            $this->userSessionService->setAuthentication($userId, $email, $fullName);

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
        $viewVariables = [];

        if (Input::postExists('signin_submit')) {
            $email = Input::post('email');
            $password = Input::post('password');

            $userDetails = $this->userService->getUserDetails($email);
            var_dump($userDetails);
            $isLoginValid = ! empty($userDetails->password) && $this->userService->verifyPassword($password, $userDetails->password);

            if ($isLoginValid) {
                $this->userSessionService->setAuthentication($userDetails->userId, $userDetails->email, $userDetails->fullname);

                redirect();
            } else {
                $viewVariables[View::ERROR_MESSAGE_KEY] = 'Incorrect login.';
            }

        }

        View::render('account/signin', 'Sign In', $viewVariables);
    }

    public function edit(): void
    {
        View::render('account/edit', 'Edit Account', ['isLoggedIn' => $this->isLoggedIn]);
    }

    public function logout(): void
    {
        $this->userSessionService->logout();

        // Redirect the user to the index page
        redirect();
    }
}