<?php

declare(strict_types=1);

use Managers\ErrorManager;
use Managers\SuccessManager;
use Managers\UserManager;
use Models\Dtos\AppState;

class AppStateFactory
{
    public function __construct(
        private readonly UserManager    $userManager,
        private readonly ErrorManager   $errorManager,
        private readonly SuccessManager $successManager,
    )
    {
    }

    public function createState(): AppState
    {
        return new AppState(
            $this->userManager->isAuthenticated(),
            $this->userManager->getUser(),
            $this->errorManager->getErrors(),
            $this->successManager->getMessages(),
        );
    }
}