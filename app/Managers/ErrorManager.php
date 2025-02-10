<?php

declare(strict_types=1);

namespace Managers;

class ErrorManager
{
    /** @var string[] */
    private array $errors;

    public function __construct()
    {
    }

    public function addError($error): void
    {
        if (gettype($error) == "object") {
            $error = $error->__toString();
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