<?php
include_once 'header.nav.php';
include_once 'footer.wave.php';

function Layout(
    string $html
): string {
    $navBar = NavBar("LyricNote", [
        new NavBarElement('#', 'Explora'),
        new NavBarElement('#', 'Eventos'),
    ]);

    $wave = Wave();
    return "
        <header>
           $navBar
        </header>
        <main>$html</main>
        <footer>
            $wave
        </footer>
    ";
}
