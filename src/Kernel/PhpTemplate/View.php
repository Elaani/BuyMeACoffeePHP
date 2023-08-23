<?php

namespace BuyMeACoffee\Kernel\PhpTemplate;

final class View
{
    public const SUCCESS_MESSAGE_KEY = "success_messsage";
    public const ERROR_MESSAGE_KEY = "error_message";
    private const MESSAGES = [
        "FILENAME_NOT_FOUND" => '"%s" does not exist.'
    ];
    private const PATH = __DIR__ . '/../../../templates/';
    private const FILE_EXTENSION = '.html.php';

    public static function render(string $view, string $title, array $context = [])
    {
        extract($context);

        require self::PATH . 'partials/header.inc.html.php';

        if (self::isViewExists($view)) {
            include_once self::PATH . $view . self::FILE_EXTENSION;
        } else {
            throw new ViewNotFound(sprintf(self::MESSAGES['FILENAME_NOT_FOUND'], $view . self::FILE_EXTENSION));
        }

        require self::PATH . 'partials/footer.inc.html.php';
    }

    private static function isViewExists(string $filename): bool
    {
        return is_file(self::PATH . $filename . self::FILE_EXTENSION);
    }
}