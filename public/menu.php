<?php

declare(strict_types=1);

use Managers\ErrorManager;
use Managers\SuccessManager;
use Models\Dtos\AppState;
use Models\Requests\OrderRequest;
use Services\OrderService;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $request = new OrderRequest();
        $request->drinkId = (int)($_POST['drink-id'] ?? null);
        $request->size = $_POST['size'] ?? null;
        $request->quantity = (int)($_POST['quantity'] ?? "1");
        $orderService = $di->container->get(OrderService::class);
        $orderService->submit($request);
        $successManager = $di->container->get(SuccessManager::class);
        $successManager->addMessage("Order placed!");
    } catch (Exception $e) {
        $errorManager = $di->container->get(ErrorManager::class);
        $errorManager->addError($e);
    }
}

$appState = $di->container->get(AppState::class);

View::renderView(basename(__FILE__));
