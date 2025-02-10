<?php

declare(strict_types=1);

use Models\Dtos\AppState;
use Services\AuthService;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();
$authService = $di->container->get(AuthService::class);
$authService->logout();

RedirectResponse::sendResponse("index.php");