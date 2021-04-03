<?php
require_once "bootstrap.php";

$gameRepo = $em->getRepository('Game');
$games = $gameRepo->findAll();
foreach ($games as $game) {
    echo sprintf("%d: %-20s\t(%d:%d)\n", $game->getId(),
        $game->getTeam1()->getCountry().'-'.$game->getTeam2()->getCountry(),
        $game->getT1Goals(), $game->getT2Goals());
}
