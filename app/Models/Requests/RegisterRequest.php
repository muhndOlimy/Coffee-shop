<?php

declare(strict_types=1);

namespace Models\Requests;

class RegisterRequest
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public int $country;
    public int $state;
    /** @var int[] */
    public array $interests;
    public string $gender;
}