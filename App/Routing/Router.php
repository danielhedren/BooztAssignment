<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\DemoController;
use App\Controller\ErrorController;
use App\Controller\HomeController;
use Exception;
use RuntimeException;

class Router
{
    /**
     * @var array<array-key, Route>
     */
    private $routes;

    public function __construct()
    {
        $this->routes[] = new Route('home_index', '/', HomeController::class, 'index');
        $this->routes[] = new Route('home_chart', '/chart', HomeController::class, 'chart');
        $this->routes[] = new Route('demo_generate', '/demo/generate', DemoController::class, 'generate');
    }

    public function match(string $path)
    {
        try {
            foreach ($this->routes as $route) {
                if ($route->matches($path)) {
                    $controller = $route->getController();
                    $method = $route->getMethod();
    
                    $controller->$method();
                    
                    return;
                }
            }

            throw new RuntimeException('Invalid route');
        } catch (Exception $e) {
            $controller = new ErrorController();
            $controller->default($e->getMessage());
        }
    }
}