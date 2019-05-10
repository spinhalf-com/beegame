<?php
/**
 * Created by PhpStorm.
 * User: johnriordan
 * Date: 2019-05-09
 * Time: 20:17
 */
namespace spec\BeeGame\Classes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use BeeGame\BeeGame;
use BeeGame\Classes\GameBuilder;
use BeeGame\Contracts\GameBuilderInterface;

class GameBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GameBuilder::class);
    }

    function it_implements_a_contract()
    {
        $this->shouldImplement(GameBuilderInterface::class);
    }

    function it_extends_a_parent()
    {
        $this->shouldBeAnInstanceOf(BeeGame::class);
    }

    function it_builds_game_conditions_from_dotenv()
    {
        //(print_r($this->getWrappedObject($this->buildGameParams())));
        $this->buildGameParams()->shouldBeArray();
    }

//    function it_instantiates_game_conditions_at_beginning_of_game()
//    {
//
//    }
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
