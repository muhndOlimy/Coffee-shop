<?php

declare(strict_types=1);

readonly class Renderable
{
    public function __construct(private string $viewPath)
    {
    }

    public function render(): void
    {
        require __DIR__ . "/../views/" . $this->viewPath;
    }
}

readonly class View extends Renderable
{
    public function __construct(string $viewPath)
    {
        parent::__construct($viewPath);
    }

    public static function renderView(string $viewPath): void
    {
        new View($viewPath)->render();
    }
}

readonly class Component extends Renderable
{
    public function __construct(string $componentPath)
    {
        parent::__construct("components/" . $componentPath);
    }

    public static function renderComponent(string $componentPath): void
    {
        new Component($componentPath)->render();
    }
}