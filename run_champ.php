<?php
// run_champ.php

include "bootstrap.php";

$countries = file('countries.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($countries as $country) {
    echo shell_exec("php create_team.php $country");
}

$teams = $em->getRepository('Team')->findAll();
foreach ($teams as $key => $team) {
    $goals1 = rand(0, 5);
    $goals2 = rand(0, 5);
    $team2_index = $key;
    do{
        $team2_index = rand(0, count($teams)-1);
    } while ($team2_index === $key);
    $team2_country = $teams[$team2_index]->getCountry();
    echo shell_exec("php create_game.php {$team->getCountry()} $team2_country $goals1 $goals2");
}
