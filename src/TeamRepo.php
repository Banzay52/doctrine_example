<?php

use Doctrine\ORM\EntityRepository;

class TeamRepo extends EntityRepository {
    public function getWins() {
        $dql = /** @lang DQL */
            "SELECT t.country, count(t) as wins FROM Team t JOIN Game g WHERE (g.team_1 = t and g.t1_goals > g.t2_goals) OR (g.team_2 = t and g.t2_goals > g.t1_goals) GROUP BY t.country";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }

    public function getLoses() {
        $dql = /** @lang DQL */
            "SELECT t.country, count(t) as loses FROM Team t JOIN Game g WHERE (g.team_1 = t and g.t1_goals < g.t2_goals) OR (g.team_2 = t and g.t2_goals < g.t1_goals) GROUP BY t.country";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }

    public function getDraws() {
        $dql = /** @lang DQL */
            "SELECT t.country, count(t) as draws FROM Team t JOIN Game g WHERE ( (g.team_1 = t OR g.team_2 = t) and g.t1_goals = g.t2_goals) GROUP BY t.country";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }

}
