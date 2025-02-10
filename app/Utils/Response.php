<?php

declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

readonly abstract class Response
{
    public abstract function send(): void;
}

readonly class JsonResponse extends Response
{
    public function __construct(private mixed $data)
    {
    }

    public function send(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->data ?? []);
    }

    public static function sendResponse(mixed $data): void
    {
        new JsonResponse($data)->send();
    }
}

readonly class RedirectResponse extends Response
{
    public function __construct(private string $path)
    {
    }

    #[NoReturn] public function send(): void
    {
        header("Location: $this->path");
        die();
    }

    #[NoReturn] public static function sendResponse(string $path): void
    {
        new RedirectResponse($path)->send();
    }
}
