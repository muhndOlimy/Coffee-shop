<?php

declare(strict_types=1);

use Models\Dtos\AppState;
use Services\DrinkService;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();
$appState = $di->container->get(AppState::class);
$drinkService = $di->container->get(DrinkService::class);

JsonResponse::sendResponse($drinkService->list());