<?php
require_once "bootstrap.php";

$country = $argv[1];
$goals = 0;
$team = $em->getRepository('Team')->findOneBy(array('country' => $country));
$games = $team->getPlayedGames();
foreach ($games as $game) {
    if ($game->getTeam1()->getCountry() == $country) {
        $goals += $game->getT1Goals();
    }
    if ($game->getTeam2()->getCountry() == $country) {
        $goals += $game->getT2Goals();
    }
}
echo $goals.PHP_EOL;
