<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\Controller;

class Route
{
    private string $name;
    private string $url;
    private string $controller;
    private string $method;
    private array $parameters;

    public function __construct(string $name, string $url, string $controller, string $method)
    {
        $this->name = $name;
        $this->url = trim($url, '/');
        $this->controller = $controller;
        $this->method = $method;
        $this->parameters = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getController(): Controller
    {
        return new $this->controller();
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array The parameters from the last call to matches().
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Checks if the given path matches this route.
     */
    public function matches(string $path): bool
    {
        // Strip leading and trailing slashes
        $path = trim($path, '/');
        // Escape forward slashes
        $pattern = str_replace('/', '\/', $this->url);
        // Replace path parameters with alphanumeric group
        $pattern = str_replace('{}', '([a-zA-Z0-9]+)', $pattern);
        $pattern = "/^{$pattern}$/";

        // Store matched parameters for further use
        $match = preg_match_all($pattern, $path, $this->parameters);

        return $match === 1;
    }
}