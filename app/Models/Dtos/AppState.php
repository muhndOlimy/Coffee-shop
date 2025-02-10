<?php

declare(strict_types=1);

namespace Models\Dtos;

use Models\Entities\User;

readonly class AppState
{

    /**
     * @param string[] $errors
     * @param string[] $messages
     */
    public function __construct(
        public bool  $isAuthenticated,
        public ?User $user,
        public array $errors,
        public array $messages,
    )
    {
    }
}