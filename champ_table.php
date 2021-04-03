<?php
include "bootstrap.php";

$table = array();
$country = null;
$sort = isset($argv[1]) ? $argv[1] : 'country';
$teamRepo = $em->getRepository('Team');
$teams = $teamRepo->findAll();
$wins  = $teamRepo->getWins();
$loses = $teamRepo->getLoses();
$draws = $teamRepo->getDraws();
foreach ($teams as $team) {
    $country = $team->getCountry();
    $team_wins = 0;
    foreach ($wins as $win) {
        if ($win['country'] == $country){
            $team_wins = $win['wins'];
            break;
        }
    }
    $team_loses = 0;
    foreach ($loses as $lose) {
        if ($lose['country'] == $country){
            $team_loses = $lose['loses'];
            break;
        }
    }
    $team_draws = 0;
    foreach ($draws as $draw) {
        if ($draw['country'] == $country){
            $team_draws = $draw['draws'];
            break;
        }
    }
    $table[] = array('country' => $country,
        'wins'  => $team_wins,
        'loses' => $team_loses,
        'draws' => $team_draws,
        'goals' => $team->getGoals()
    );
}
usort($table, function($raw1, $raw2) use ($sort) {
    return ($raw1[$sort] > $raw2[$sort]) ? -1 : 1;
});
echo sprintf("%10s\tW\tL\tD\tGoals\n", ' ');
foreach ($table as $row) {
    echo sprintf("%10s\t%d\t%d\t%d\t%d\n", $row['country'], $row['wins'], $row['loses'], $row['draws'], $row['goals']);
}