<?php

header("Content-Type: application/json");

include_once 'repository/repository.manager.php';

$routes = [];

function Route($method, $route, callable $controller): void
{
    global $routes;
    $routes[$method][$route] = $controller;
}

Route('POST', 'auth', function () {
    $body = Body();
    $username = $body['username'];
    $password = $body['password'];

    $user = getRepo("user")->find($username);
    if ($user == null) {
        Error("User not found");
        return;
    }

    if ($user->password != $password) {
        Error("Invalid password");
        return;
    }

    echo json_encode([
        "token" => parseToken($username, $password)
    ]);
});

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

function parseToken($user, $pass): string {
    return base64_encode($user . ":" . $pass);
}

function currentUser($body): User
{
    $token = $body['token'];
    $credential = getCredential($token);
    $username = $credential[0];
    return getRepo("user")->find($username);
}

function getCredential($token): array {
    $credential = base64_decode($token);
    return explode(":", $credential);
}

execute();
