<?php

declare(strict_types=1);

namespace BuyMeACoffee\Kernel\Http;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class Router {
    private const CONTROLLER_NAMESPACE = 'BuyMeACoffee\Controller\\';
    private const CONTROLLER_SEPARATOR = '@';

    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    private const METHOD_GET_AND_POST = 'GET_POST';

    private static ?string $httpMethod;

    public static function get(string $uri, string $classMethod = ''){
        self::$httpMethod = self::METHOD_GET;

        self::execute($uri, $classMethod);
    }

    public static function post(string $uri, string $classMethod = ''): void {
        self::$httpMethod = self::METHOD_POST;

        self::execute($uri, $classMethod);
    }

    public static function getAndPost(string $uri, string $classMethod = ''): void {
        self::$httpMethod = self::METHOD_GET_AND_POST;

        self::execute($uri, $classMethod);
    }

    public static function execute(string $uri, string $method) {
        $uri = '/' . trim($uri, '/');
        $url = !empty($_GET['uri']) ? '/' . $_GET['uri'] : '/';
    
        if (preg_match("#^$uri$#", $url, $params)) {
            if (self::isRedirection($method)) {
                header(
                    sprintf('Location: %s/%s', $_ENV['SITE_URL'], $method)
                );
            } elseif (self::isHttpMethodValid()) {
                    $split = explode(self::CONTROLLER_SEPARATOR, $method);
                    $className = self::CONTROLLER_NAMESPACE . $split[0];
                    $method = $split[1];

                    try {
                        $reflection = new ReflectionClass($className);
                        // Check if the class has methods
                        if (class_exists($className) && $reflection->hasMethod($method)) {
                            $action = new ReflectionMethod($className, $method);
                            // Make sure the requested action has "public" visibility
                            if ($action->isPublic()) {
                                // Now, we perform the controller's action
                                return $action->invokeArgs(new $className, self::getActionParameters($params));
                            }
                        }
                    } catch (ReflectionException $err) {
                        echo $err->getMessage();
                    }
                } else {
                    throw new InvalidArgumentException(sprintf('Invalid "%s" HTTP Request', $_SERVER['REQUEST_METHOD']));
                }
                
            
        }
    }

    private static function isHttpMethodValid(): bool {
        if (self::$httpMethod === self::METHOD_GET_AND_POST) {
            return $_SERVER['REQUEST_METHOD'] === self::METHOD_GET || $_SERVER['REQUEST_METHOD'] === self::METHOD_POST; 
        }
        return $_SERVER['REQUEST_METHOD'] === self::$httpMethod;
    }

    private static function getActionParameters(array $params): array {
        forEach($params as $key => $value) {
            $params[$key] = str_replace('/', '', $params);
        }
        return $params;
    }

    private static function isRedirection(string $method): bool {
        return !str_contains($method, self::CONTROLLER_SEPARATOR);
    }
}