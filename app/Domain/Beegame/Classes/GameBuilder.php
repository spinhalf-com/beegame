<?php
/**
 * Created by PhpStorm.
 * User: johnriordan
 * Date: 2019-05-09
 * Time: 20:09
 */
namespace BeeGame\Classes;

use BeeGame\BeeGame;
use BeeGame\Contracts\GameBuilderInterface;

class GameBuilder extends BeeGame implements GameBuilderInterface
{
    public $gameState;
    public $gameParams;
    public $playArray;
    public $iterator = 0;

    function __construct()
    {
        parent::__construct();
    }

    public function buildGameState()
    {
        $this->gameState = [
            'game_over' => false,
            'last_shot' => [
                'bee_type' => '',
                'points' => null,
                'shot_count' => 0
            ],
            'play_array' => [],
            'game_params' => []
        ];

        $this->gameState['game_params'] = $this->buildGameParams();

        foreach ($this->gameState['game_params'] as $gameParam) {
            $this->buildBees($gameParam);
        }

        $this->gameState['play_array'] = $this->playArray;

        return $this->gameState;
    }

    public function buildGameParams()
    {
        $gameParams = [];

        $gameParams['queen'] = $this->setBee('QUEEN');
        $gameParams['worker'] = $this->setBee('WORKER');
        $gameParams['drone'] = $this->setBee('DRONE');

        return $gameParams;
    }

    public function setBee($pre)
    {
        $arr = [];

        $arr['count'] = getenv($pre . '_INITIAL');
        $arr['lifespan'] = getenv($pre . '_LIFESPAN');
        $arr['hit'] = getenv($pre . '_HIT');
        $arr['type'] = $pre;

        return $arr;
    }

    public function getBee($iterator)
    {
        return $this->gameState['play_array'][$iterator];
    }

    public function buildBees($bee)
    {
        $count = $bee['count'];
        $x = 0;

        while ($x < $count) {
            $beeTypeArray = [];

            $beeTypeArray['lifespan'] = $bee['lifespan'];
            $beeTypeArray['hit'] = $bee['hit'];
            $beeTypeArray['type'] = $bee['type'];

            $this->playArray[$this->iterator] = $beeTypeArray;
            $this->iterator++;
            $x++;
        }
        return $this->playArray;
    }
}