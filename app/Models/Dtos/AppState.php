<?php

declare(strict_types=1);

namespace Models\Dtos;

use Models\Entities\User;

readonly class AppState
{

    /** @param string[] $errors */
    public function __construct(
        public bool  $isAuthenticated,
        public ?User $user,
        public array $errors,
    )
    {
    }
}