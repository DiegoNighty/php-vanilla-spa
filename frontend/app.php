<?php

// Router
include_once 'router/router.php';

// Components
include_once 'component/layout.php';

// Pages
include_once 'pages/home.php';
include_once 'pages/test.php';

$router = new Router();
$router->Page("home", "Home", false, true);
$router->Page("test", "Test");

echo Layout(
    $router->CurrentPage()
);

