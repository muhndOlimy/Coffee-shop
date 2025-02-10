<?php

declare(strict_types=1);

use Models\Dtos\AppState;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();
$appState = $di->container->get(AppState::class);

View::renderView(basename(__FILE__));