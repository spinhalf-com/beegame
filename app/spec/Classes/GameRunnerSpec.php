<?php

namespace spec\BeeGame\Classes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use BeeGame\BeeGame;
use BeeGame\Classes\GameRunner;
use BeeGame\Contracts\GameRunnerInterface;

class GameRunnerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GameRunner::class);
    }

    function it_implements_a_contract()
    {
        $this->shouldImplement(GameRunnerInterface::class);
    }

    function it_extends_a_parent()
    {
        $this->shouldBeAnInstanceOf(BeeGame::class);
    }

    public function it_returns_a_random_array_item()
    {
        $beeKeys = [0,3,4,6,8,11,13];

        $this->randomIndex($beeKeys)->shouldBeNumeric();
    }
//
//    function it_returns_a_hits_value_for_bee_type()
//    {
//
//    }
//
//    function it_returns_a_status_for_bee_type()
//    {
//
//    }
}
