<?php

declare(strict_types=1);

namespace Managers;

use Exception;
use Models\Entities\User;

class SuccessManager
{
    /** @var string[] */
    private array $messages;

    public function __construct()
    {
    }

    public function addMessage($error): void
    {
        if (gettype($error) == "object") {
            $error = $error->__toString();
        }
        if (gettype($error) == 'string') {
            $this->messages[] = $error;
        }
    }

    public function clearMessages(): void
    {
        unset($this->messages);
    }

    /** @return string[] */
    public function getMessages(): array
    {
        return $this->messages ?? [];
    }
}