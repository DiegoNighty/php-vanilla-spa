<?php

header("Content-Type: application/json");

include_once 'repository/repository.manager.php';

$routes = [];

function Route($method, $route, callable $controller): void
{
    global $routes;
    $routes[$method][$route] = $controller;
}

Route('GET', 'find', function () {
    $id = $_GET['id'];
    $repo = $_GET['repo'];
    echo json_encode(getRepo($repo)->find($id));
});

Route('GET', 'findAll', function () {
    $repo = $_GET['repo'];
    $id = $_GET['id'];
    echo json_encode(getRepo($repo)->findAll($id));
});

Route('POST', "save", function () {
    $body = Body();
    $repo = $body['repo'];
    $repository = getRepo($repo);
    $model = $repository->serializer->deserialize($body['model']);
    $result = $repository->save($model);

    echo json_encode([
        "result" => $result
    ]);
});

function execute(): void
{
    global $params;
    global $routes;
    $method = $_SERVER['REQUEST_METHOD'];

    $params = Params();

    if (!isset($routes[$method])) {
        Error("Method not allowed");
        return;
    }
    $routesByMethod = $routes[$method];

    if (!isset($params['route'])) {
        Error("Route not found");
        return;
    }
    $route = $params['route'];

    if (!isset($routesByMethod[$route])) {
        Error("Controller not found");
        return;
    }
    $controller = $routesByMethod[$route];

    $controller();
}

function Error($message): void
{
    echo json_encode([
        "error" => $message
    ]);
}

function Params(): array
{
    $params = [];
    $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    parse_str($queryString, $params);

    return $params;
}

function Body(): mixed
{
    return json_decode(file_get_contents("php://input"), true);
}

execute();
