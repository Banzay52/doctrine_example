<?php
require_once "bootstrap.php";

echo "WINS TABLE\n";
$wins = $em->getRepository('Team')->getWins();
foreach ($wins as $win) {
    echo $win['country'] ." : " .$win['wins'].PHP_EOL;
}
echo "LOSES TABLE\n";
$loses = $em->getRepository('Team')->getLoses();
foreach ($loses as $lose) {
    echo $lose['country'] ." : " .$lose['loses'].PHP_EOL;
}
echo "DRAWS TABLE\n";
$draws = $em->getRepository('Team')->getDraws();
foreach ($draws as $draw) {
    echo $draw['country'] ." : " .$draw['draws'].PHP_EOL;
}
