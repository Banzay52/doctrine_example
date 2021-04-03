<?php
require_once "bootstrap.php";

$country_name = $argv[1];

$team = new Team();
$team->setCountry($country_name);
$em->persist($team);
try {
    $em->flush();
} catch (\Exception $e) {
    echo "EXCEPTION OCCURRED.\n{$e->getMessage()}\n";
    exit(1);
}
echo "Team {$team->getCountry()} created.\n";
