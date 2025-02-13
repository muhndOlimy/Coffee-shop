<?php

declare(strict_types=1);

use Managers\SuccessManager;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();
$viewFactory = $di->container->get(ViewFactory::class);

$successManager = $di->container->get(SuccessManager::class);
if (isset($_REQUEST['login']) && $_REQUEST['login'] === 'true') {
    $successManager->addMessage("Welcome back!");
} else if (isset($_REQUEST['register']) && $_REQUEST['register'] === 'true') {
    $successManager->addMessage("Welcome!");
}

$viewFactory->renderView(basename(__FILE__));