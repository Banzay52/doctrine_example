<?php
require_once "bootstrap.php";

$country1_name = $argv[1];
$country2_name = $argv[2];
$t1_goals = $argv[3];
$t2_goals = $argv[4];

$team1 = $em->getRepository('Team')->findOneBy(array('country' => $country1_name));
$team2 = $em->getRepository('Team')->findOneBy(array('country' => $country2_name));
if ( !$team1 ) {
    echo "No {$country1_name} team found.\n";
    exit(1);
} elseif ( !$team2 ) {
    echo "No {$country2_name} team found.\n";
    exit(1);
} elseif ($team2 === $team1) {
    echo "Wrong team names.\n";
    exit(1);
}

$game = new Game();
$game->setTeams($team1, $team2);
$game->setGameResult($t1_goals, $t2_goals);
$em->persist($game);
$em->flush();

echo "Game {$team1->getCountry()}:{$team2->getCountry()} with result {$t1_goals}:{$t2_goals} saved.\n";