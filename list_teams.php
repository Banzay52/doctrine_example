<?php
require_once "bootstrap.php";

$teamRepo = $em->getRepository('Team');
$teams = $teamRepo->findAll();
foreach ($teams as $team) {
    echo "{$team->getId()}: {$team->getCountry()}\n";
}
