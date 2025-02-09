<?php

declare(strict_types=1);

namespace Managers;

use Models\Entities\User;

class UserManager
{
    private const string KEY = 'auth_user';

    public function __construct()
    {
    }

    public function ensureAuthentication()
    {
        if (!$this->isAuthenticated()) {
            throw new \Exception("User is not authorized");
        }
    }

    public function isAuthenticated(): bool
    {
        return array_key_exists(self::KEY, $_SESSION);
    }

    public function getUser(): ?User
    {
        return $_SESSION[self::KEY] ?? null;
    }

    public function setUser(User $user): void
    {
        $_SESSION[self::KEY] = $user;
    }
}