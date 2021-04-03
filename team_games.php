<?php
require_once "bootstrap.php";

if (!isset($argv[1])) {
    echo "Country name should be passed as argument\n";
    exit();
}
$country = $argv[1];

$team = $em->getRepository('Team')->findOneBy(array('country' => $country));
if (!$team) {
    echo "$country not found.\n";
    exit();
}
$games = $team->getPlayedGames();
echo count($games)." games played by $country team.".PHP_EOL;
foreach ($games as $game) {
    $color = "\033[01;33m";
    if ($game->getTeam1()->getCountry() == $country) {
        if ($game->getT1Goals() > $game->getT2Goals()) {
            $color = "\033[01;32m";
        } elseif ($game->getT1Goals() < $game->getT2Goals()) {
            $color = "\033[01;31m";
        }
    } else {
        if ($game->getT1Goals() < $game->getT2Goals()) {
            $color = "\033[01;32m";
        } elseif ($game->getT1Goals() > $game->getT2Goals()) {
            $color = "\033[01;31m";
        }
    }
    $team1 = ($game->getTeam1()->getCountry() == $country) ? "\033[01;32m".$country."\033[0m" : $game->getTeam1()
        ->getCountry();
    $team2 = ($game->getTeam2()->getCountry() == $country) ? "\033[01;32m".$country."\033[0m" : $game->getTeam2()
        ->getCountry();
    echo "{$game->getId()}:\n  Teams: $team1-$team2\n";
    echo "  Result: $color{$game->getT1Goals()}:{$game->getT2Goals()}\033[0m\n";
}
