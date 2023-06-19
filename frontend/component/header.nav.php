<?php
include_once '../credential.php';

class NavBarElement {
    public string $href;
    public string $text;

    public function __construct(
        string $href,
        string $text
    ) {
        $this->href = $href;
        $this->text = $text;
    }
}

function NavBar(string $logo, array $links): string {
    $linksHtml = '';

    foreach ($links as $link) {
        $linksHtml .= "<li><a class='navbar-link' href='$link->href'>$link->text</a></li>";
    }

    $sessionHtml = '';

    if (getUser() == null) {
        $sessionHtml = "<a class='navbar-link-login' href='user/login'>Iniciar sesión</a>";
    } else {
        $sessionHtml = "<a class='navbar-link-login' href='user/logout'>Cerrar sesión</a>";
    }

    return "
      <link rel='stylesheet' href='../frontend/style/navbar.css'>
      <nav class='navbar'>
        <div class='navbar-logo'>
            <a class='navbar-logo logo-icon' href='home'>$logo</a>
        </div>
        <div class='navbar-left'>
            <ul class='navbar-links'>
                $linksHtml
            </ul>
        </div>
        <div class='navbar-right'>
            $sessionHtml
        </div>
      </nav>
  ";
}
