<?php
function getURL($id): string {
    return "http://diegonoches.ninja/lyricnote/web/backend/api.php?route=find&repo=user&id=$id";
}

function getUser(): array|null {
    if (!isset($_GET['token'])) {
        return null;
    }

    $token = base64_decode($_GET['token']);
    $parts = explode(":", $token);
    $username = $parts[0];
    $password = $parts[1];

    $json = file_get_contents(getURL($username));
    $user = json_decode($json, true);
    if ($user == null) {
        return null;
    }

    if ($user["password"] != $password) {
        return null;
    }

    return $user;
}