<?php

include 'repository/repository.php';
include 'repository/model.php';
include 'model/artist.php';
include 'model/event.php';
include 'model/user.php';
include 'model/song.php';
include 'model/review.php';

$mysqli = new mysqli(
    "localhost",
    "12341",
    "4124124!",
    "412412414"
);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$userRepo = new Repository(
    $mysqli,
    "user",
    "username",
    new UserSerializer()
);

$artistRepo = new Repository(
    $mysqli,
    "artist",
    "name",
    new ArtistSerializer()
);

$eventRepo = new Repository(
    $mysqli,
    "event",
    "artist",
    new EventSerializer()
);

$songRepo = new Repository(
    $mysqli,
    "song",
    "title",
    new SongSerializer()
);

$reviewRepo = new Repository(
    $mysqli,
    "reviews",
    "username",
    new ReviewSerializer()
);