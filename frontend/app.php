<?php

// Router
include_once 'router/router.php';

// Components
include_once 'component/layout.php';

// Pages
include_once 'pages/home.php';
include_once 'pages/test.php';
include_once 'pages/artist.submit.php';
include_once 'pages/user.login.php';

$router = new Router();
$router->Page("home", "Home", false, true);
$router->Page("test", "Test");
$router->Page("artist/submit", "SubmitArtist", true);
$router->Page("user/login", "UserLogin", true);

echo Layout(
    $router->CurrentPage()
);