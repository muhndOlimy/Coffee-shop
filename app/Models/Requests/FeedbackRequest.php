<?php

declare(strict_types=1);

namespace Models\Requests;

class FeedbackRequest
{
    public string $name;
    public string $email;
    public string $message;
}