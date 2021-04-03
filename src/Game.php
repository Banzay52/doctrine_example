<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="games")
 */
class Game {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="played_games_1")
     * @var Team
     */
    protected $team_1;
    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="played_games_2")
     * @var Team
     */
    protected $team_2;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $t1_goals;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $t2_goals;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
    /**
     * @param Team $team_1
     */
    public function setTeam1(Team $team_1): void {
        $team_1->addPlayedGame1($this);
        $this->team_1 = $team_1;
    }

    /**
     * @param Team $team_2
     */
    public function setTeam2(Team $team_2): void {
        $team_2->addPlayedGame2($this);
        $this->team_2 = $team_2;
    }

    /**
     * @return Team
     */
    public function getTeam1(): Team {
        return $this->team_1;
    }

    /**
     * @return Team
     */
    public function getTeam2(): Team {
        return $this->team_2;
    }

    public function setTeams(Team $t1, Team $t2) {
        $this->setTeam1($t1);
        $this->setTeam2($t2);
    }

    /**
     * @param mixed $t1_goals
     */
    public function setT1Goals($t1_goals): void {
        $this->t1_goals = $t1_goals;
    }

    /**
     * @param mixed $t2_goals
     */
    public function setT2Goals($t2_goals): void {
        $this->t2_goals = $t2_goals;
    }

    /**
     * @return mixed
     */
    public function getT1Goals() {
        return $this->t1_goals;
    }

    /**
     * @return mixed
     */
    public function getT2Goals() {
        return $this->t2_goals;
    }

    public function setGameResult(int $t1_goals, int $t2_goals) {
        $this->setT1Goals($t1_goals);
        $this->setT2Goals($t2_goals);
    }
}
