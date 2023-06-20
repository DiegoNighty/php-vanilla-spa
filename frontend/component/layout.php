<?php
include_once 'header.nav.php';

function Layout(
    string $html
): string {
    $navBar = NavBar("LyricNote", [
        new NavBarElement('#', 'Explora'),
        new NavBarElement('#', 'Eventos'),
    ]);

    return "
        <header>
           $navBar
        </header>
        <main>$html</main>
    ";
}
