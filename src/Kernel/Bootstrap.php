<?php

namespace BuyMeACoffee\Kernel;

use BuyMeACoffee\Kernel\Database\Database;
use Symfony\Component\Dotenv\Dotenv;

final class Bootstrap
{
    public function __construct()
    {
        // First, load the environment variables
        $dotenv = new Dotenv();
        $this->loadEnvironmentVariables($dotenv);

        // Then, initialize the database connection (we need the ENV vars to be loaded before)
        $this->initializeDatabase();
    }

    public function run(): void
    {
        require dirname(__DIR__, 1) . '/routes.php';
    }

    private function initializeDatabase()
    {
        $dbDetails = [
            'db_host' => $_ENV['DB_HOST'],
            'db_name' => $_ENV['DB_NAME'],
            'db_user' => $_ENV['DB_USER'],
            'db_password' => $_ENV['DB_PASSWORD']
        ];
        Database::connect($dbDetails);
    }

    private function loadEnvironmentVariables(Dotenv $dotenv): void
    {
        $dotenv->load(dirname(__DIR__, 2) . '/.env');
    }
}