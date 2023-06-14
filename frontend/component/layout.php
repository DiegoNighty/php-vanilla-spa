<?php
include_once 'logo.php';

function Layout(
    string $html
): string {
    $logo = Logo();
    return "
        <header>
           <div>$logo</div>
        </header>
        <main>$html</main>
        <footer>
            <p>Footer</p>
        </footer>
    ";
}
