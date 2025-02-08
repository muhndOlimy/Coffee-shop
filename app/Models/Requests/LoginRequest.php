<?php

declare(strict_types=1);

namespace Models\Requests;

class LoginRequest
{
    public string $email;
    public string $password;
}