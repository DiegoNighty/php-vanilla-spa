<?php

include_once 'repository.php';
include_once 'model.php';
include_once '../model/artist.php';
include_once '../model/event.php';
include_once '../model/user.php';
include_once '../model/song.php';
include_once '../model/review.php';

$mysqli = new mysqli(
    "localhost",
    "id20378455_diegonighty",
    "OMGtILIN1234!",
    "id20378455_lyricnote"
);

if ($mysqli->connect_errno) {
    echo json_encode(array(["error" => $mysqli->connect_error]));
}

$repos = [];

$repos["user"] = new Repository(
    $mysqli,
    "user",
    "username",
    new UserSerializer()
);

$repos["artist"] = new Repository(
    $mysqli,
    "artist",
    "name",
    new ArtistSerializer()
);

$repos["event"] = new Repository(
    $mysqli,
    "event",
    "artist",
    new EventSerializer()
);

$repos["song"] = new Repository(
    $mysqli,
    "song",
    "title",
    new SongSerializer()
);

$repos["review"] = new Repository(
    $mysqli,
    "review",
    "username",
    new ReviewSerializer()
);

function getRepo($name): Repository {
    global $repos;
    return $repos[$name];
}