<?php

declare(strict_types=1);

use Managers\ErrorManager;
use Managers\SuccessManager;
use Models\Dtos\AppState;
use Models\Requests\FeedbackRequest;
use Services\AuthService;
use Services\FeedbackService;

require_once __DIR__ . "/../vendor/autoload.php";

$di = new DI();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $request = new FeedbackRequest();
        $request->name = $_POST['name'] ?? "";
        $request->email = $_POST['email'] ?? "";
        $request->message = $_POST['message'] ?? "";
        $feedbackService = $di->container->get(FeedbackService::class);
        $feedbackService->submit($request);
        $successManager = $di->container->get(SuccessManager::class);
        $successManager->addMessage("Feedback received!");
    } catch (Exception $e) {
        $errorManager = $di->container->get(ErrorManager::class);
        $errorManager->addError($e);
    }
}

$viewFactory = $di->container->get(ViewFactory::class);
$viewFactory->renderView(basename(__FILE__));
