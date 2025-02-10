<?php

declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();
$viewFactory = $di->container->get(ViewFactory::class);
$viewFactory->renderView(basename(__FILE__));