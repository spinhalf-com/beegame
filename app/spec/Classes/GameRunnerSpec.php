<?php

namespace spec\BeeGame\Classes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use BeeGame\BeeGame;
use BeeGame\Classes\GameRunner;
use BeeGame\Classes\GameBuilder;
use BeeGame\Contracts\GameRunnerInterface;
use spec\BeeGame\BeeGameSpec;

class GameRunnerSpec extends BeeGameSpec
{
    private $gameState;

    function __construct()
    {
        parent::__construct();
        $gameBuilder = new GameBuilder();
        $this->gameState = $gameBuilder->buildGameState();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GameRunner::class);
    }

    public function it_implements_a_contract()
    {
        $this->shouldImplement(GameRunnerInterface::class);
    }

    public function it_extends_a_parent()
    {
        $this->shouldBeAnInstanceOf(BeeGame::class);
    }

    public function it_returns_a_random_array_item()
    {
        $beeKeys = [0,3,4,6,8,11,13];

        $this->randomIndex($beeKeys)->shouldBeNumeric();
    }

    public function it_returns_an_array_of_living_bees()
    {
        $this->returnLivingBeeIndex($this->gameState['play_array'])->shouldHaveCount(14);
    }

    public function it_works_out_if_a_bee_is_alive()
    {
        $this->isBeeDead($this->gameState['play_array'][0])->shouldReturn(false);
    }

    public function it_returns_game_over_status()
    {
        $this->isGameOver($this->gameState['play_array'])->shouldReturn(false);
    }

    public function it_should_make_a_shot()
    {
        $this->run($this->gameState)->shouldNotBeEqualTo($this->gameState);
//        $this->gameState->shoot();
    }

    public function it_should_return_a_positive_shot_count()
    {
        $this->run($this->gameState);
        $this->returnShotCount()->shouldBeEqualTo(1);
    }

    public function it_should_specify_a_bee_type_that_was_shot()
    {
        $this->run($this->gameState)->shouldHaveArrayWithLastShotData('bee_type');
    }

    public function it_should_specify_a_hit_value_for_last_shot()
    {
        $this->run($this->gameState)->shouldHaveArrayWithLastShotData('points');
    }
}
