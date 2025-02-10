<?php

declare(strict_types=1);

use Managers\ErrorManager;
use Managers\SuccessManager;
use Models\Dtos\AppState;
use Models\Requests\RegisterRequest;
use Services\AuthService;
use Services\CategoryService;
use Services\CountryService;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $request = new RegisterRequest();
        $request->firstName = $_POST['first-name'] ?? "";
        $request->lastName = $_POST['last-name'] ?? "";
        $request->email = $_POST['email'] ?? "";
        $request->password = $_POST['password'] ?? "";
        $request->gender = $_POST['gender'] ?? "";
        $request->interests = array_map(fn($el) => (int)$el, $_POST['interests'] ?? []);
        $request->country = (int)($_POST['country'] ?? null);
        $request->state = (int)($_POST['state'] ?? null);
        $authService = $di->container->get(AuthService::class);
        $authService->register($request);
        $successManager = $di->container->get(SuccessManager::class);
        $successManager->addMessage("Welcome!");
    } catch (Exception $e) {
        $errorManager = $di->container->get(ErrorManager::class);
        $errorManager->addError($e);
    }
}

$appState = $di->container->get(AppState::class);

if ($appState->isAuthenticated) {
    RedirectResponse::sendResponse("index.php");
} else {
    $countries = $di->container->get(CountryService::class)->list();
    $categories = $di->container->get(CategoryService::class)->list();
    View::renderView(basename(__FILE__));
}
