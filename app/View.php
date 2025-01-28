<?php

declare(strict_types=1);

readonly class View
{
    public function __construct(private string $viewPath) {}

    public function render(): void {
        require __DIR__ . "/../views/" . $this->viewPath;
    }

    public static function renderView(string $viewPath): void
    {
        new View($viewPath)->render();
    }
}