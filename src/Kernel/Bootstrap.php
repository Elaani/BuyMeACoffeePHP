<?php

namespace BuyMeACoffee\Kernel;

use Symfony\Component\Dotenv\Dotenv;

final class Bootstrap
{
    public function __construct()
    {
        $dotenv = new Dotenv();
        $this->loadEnvironmentVariables($dotenv);
    }

    public function run(): void
    {
        require dirname(__DIR__, 1) . '/routes.php';
    }

    private function initialize()
    {

    }

    private function loadEnvironmentVariables(Dotenv $dotenv): void
    {
        $dotenv->load(dirname(__DIR__, 2) . '/.env');
    }
}