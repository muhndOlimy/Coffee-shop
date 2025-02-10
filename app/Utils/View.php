<?php

declare(strict_types=1);

readonly abstract class Renderable
{
    public function __construct(protected string $viewPath)
    {
    }

    public function render(): void
    {
        require __DIR__ . "/../../views/" . $this->viewPath;
    }
}

readonly class View extends Renderable
{
    public function __construct(string $viewPath)
    {
        parent::__construct($viewPath);
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

readonly class ViewFactory
{
    public function __construct(private AppStateFactory $appStateFactory)
    {
    }

    public function renderView(string $viewPath, array $viewParams = []): void
    {
        extract($viewParams);
        global $appState;
        $appState = $this->appStateFactory->createState();
        new View($viewPath)->render();
    }
}