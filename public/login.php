<?php

declare(strict_types=1);

use Managers\ErrorManager;
use Managers\SuccessManager;
use Models\Dtos\AppState;
use Models\Requests\LoginRequest;
use Services\AuthService;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $request = new LoginRequest();
        $request->email = $_POST['email'] ?? "";
        $request->password = $_POST['password'] ?? "";
        $authService = $di->container->get(AuthService::class);
        $authService->login($request);
        $successManager = $di->container->get(SuccessManager::class);
        $successManager->addMessage("Welcome back!");
    } catch (Exception $e) {
        $errorManager = $di->container->get(ErrorManager::class);
        $errorManager->addError($e);
    }
}

$appState = $di->container->get(AppState::class);

if ($appState->isAuthenticated) {
    RedirectResponse::sendResponse("index.php");
} else {
    View::renderView(basename(__FILE__));
}
