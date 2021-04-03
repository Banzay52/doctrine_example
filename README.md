This is example of doctrine 2 implementation as ORM to project
###The source code implements simple model of football champ.###
To check the Open CLI, go to the root of prject dir and run following commands:

1. Edit db connection params ( db_name / host / user / password ) in bootstrap.php 
2. create database <db_name>
3. > composer install
4. > php -f bootstrap.php

5. If no errors, run
> php -f run_champ.php
 
6. To check some country team results run
> php -f team_games.php country_name

country_name would be taken from countries.txt