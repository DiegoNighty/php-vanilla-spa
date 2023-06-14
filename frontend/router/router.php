<?php

class Router {
    private array $routes = [];
    private array $dynamicRoutes = [];
    private string $DEFAULT_ROUTE;

    public function Page(string $route, callable $page, bool $dynamic = false, bool $asDefault = false): void
    {
        $this->routes[$route] = $page;

        if ($asDefault) {
            $this->DEFAULT_ROUTE = $route;
        }

        if ($dynamic) {
            $this->dynamicRoutes[$route] = $route;
        }
    }

    public function Error(string $pageRoute): void
    {
        $this->routes['error'] = $pageRoute;
    }

    public function CurrentPage(): string
    {
        $route = $_GET['route'] ?? $this->DEFAULT_ROUTE;

        if (array_key_exists($route, $this->routes)) {
            if (array_key_exists($route, $this->dynamicRoutes)) {
                echo '<dynamic>';
            }

            return $this->routes[$route]();
        } else {
            return $this->routes['error']();
        }
    }
}