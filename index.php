<?php

use BuyMeACoffee\Kernel\Bootstrap;

require __DIR__ . '/vendor/autoload.php';

ob_start();
$app = new Bootstrap();
$app->run();
ob_end_flush();