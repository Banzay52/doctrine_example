<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="TeamRepo")
 * @ORM\Table(name="teams")
 */
class Team {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     * @var string
     */
    protected $country;
    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="team_1")
     * @var ArrayCollection
     */
    protected $played_games_1;
    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="team_2")
     * @var ArrayCollection
     */
    protected $played_games_2;

    public function __construct() {
        $this->played_games_1 = new ArrayCollection();
        $this->played_games_2 = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param mixed $country
     */
    public function setCountry(string $country): void {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry(): string {
        return $this->country;
    }

    /**
     * @param Game $played_game
     */
    public function addPlayedGame1(Game $played_game): void {
        $this->played_games_1[] = $played_game;
        echo $this->getCountry() . " games played: " . count($this->getPlayedGames()).PHP_EOL;
    }
    /**
     * @param Game $played_game
     */
    public function addPlayedGame2(Game $played_game): void {
        $this->played_games_2[] = $played_game;
        echo $this->getCountry() . " games played: " . count($this->getPlayedGames()).PHP_EOL;
    }

    /**
     * @return Game[]
     */
    public function getPlayedGames() {
        return array_merge($this->played_games_1->getValues(), $this->played_games_2->getValues());
    }

    /**
     * @return int
     */
    public function getGoals() {
        $goals = 0;
        $games = $this->getPlayedGames();
        $country = $this->getCountry();
        foreach ($games as $game) {
            if ($game->getTeam1()->getCountry() == $country) {
                $goals += $game->getT1Goals();
            }
            if ($game->getTeam2()->getCountry() == $country) {
                $goals += $game->getT2Goals();
            }
        }
        return $goals;
    }
}