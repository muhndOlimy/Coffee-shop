<?php

declare(strict_types=1);

namespace Managers;

use Exception;

class ErrorManager
{
    /** @var string[] */
    private array $errors;

    public function __construct()
    {
    }

    public function addError(Exception|string $error): void
    {
        if ($error instanceof Exception) {
            $error = $error->getMessage();
        }
        if (gettype($error) == 'string') {
            $this->errors[] = $error;
        }
    }

    public function clearErrors(): void
    {
        unset($this->errors);
    }

    /** @return string[] */
    public function getErrors(): array
    {
        return $this->errors ?? [];
    }
}