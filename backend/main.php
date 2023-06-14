<?php

include 'repository/repository.manager.php';
global $artistRepo, $eventRepo;

$test = $artistRepo->find("test");
if (is_null($test)) {
    echo " No encontrado! ";
    return;
}

echo "<br>Artista: " . $test->getName() . "!";

$events = $eventRepo->findAll("test");

for ($i = 0; $i < count($events); $i++) {
    $event = $events[$i];
    echo "<br>Evento: " . $event->getType() . "!";
    echo "<br>Lugar: " . $event->getLocation() . "!";

    echo "<br>";
}