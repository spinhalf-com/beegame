<?php
/**
 * Created by PhpStorm.
 * User: johnriordan
 * Date: 2019-05-09
 * Time: 16:29
 */
namespace BeeGame\Classes;

use BeeGame\Contracts\GameRunnerInterface;
use BeeGame\BeeGame;

class GameRunner extends BeeGame implements GameRunnerInterface
{
    protected $gameState;
    protected $shotCount;

    public function __construct()
    {
        parent::__construct();
    }

    public function run($gameState)
    {
        $this->gameState = $gameState;
        $this->shoot();
        return $this->gameState;
    }

    public function returnLivingBeeIndex($bees)
    {
        $livingBees = [];

        foreach ($bees as $key => $bee) {
            if(!$this->isBeeDead($bee)) {
                $livingBees[] = $key;
            }
        }
        return $livingBees;
    }

    public function isBeeDead($bee)
    {
        return($bee['lifespan'] < 0) ? true: false;
    }

    public function isGameOver($gameData)
    {
        if($this->isBeeDead($gameData[0])) {
            return true;
        }

        $gameOver = true;

        foreach ($gameData as $k => $bee) {
            if(!$this->isBeeDead($bee)) {
                $gameOver = false;
            }
        }
        return $gameOver;
    }

    public function shoot()
    {
        $bees = $this->gameState['play_array'];

        $livingBees = $this->returnLivingBeeIndex($bees);

        $indexOfBeeShot = $this->randomIndex($livingBees);

        $beeStateAfterShot = $this->setNewBeeLifespan($indexOfBeeShot);
        $this->shotCount = $this->gameState['last_shot']['shot_count'] + 1;
    }

    public function randomIndex($livingBees)
    {
        return array_rand($livingBees, 1);
    }

    public function setNewBeeLifespan($indexOfBeeShot)
    {
        $shotBee = $this->gameState['play_array'][$indexOfBeeShot];

        $newLifespan = $shotBee['lifespan'] - $shotBee['hit'];
        $shotBee['lifespan'] = $newLifespan;

        $this->gameState['last_shot']['bee_type'] = $shotBee['type'];
        $this->gameState['last_shot']['points'] = $shotBee['hit'];
        $this->gameState['last_shot']['shot_count'] = $this->shotCount;
        $this->gameState['play_array'][$indexOfBeeShot] = $shotBee;
        $this->gameState['game_over'] = $this->isGameOver($this->gameState['play_array']);
    }
}