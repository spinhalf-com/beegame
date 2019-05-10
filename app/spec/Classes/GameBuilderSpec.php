<?php
/**
 * Created by PhpStorm.
 * User: johnriordan
 * Date: 2019-05-09
 * Time: 20:17
 */
namespace spec\BeeGame\Classes;

use spec\BeeGame\BeeGameSpec;
use Prophecy\Argument;

use BeeGame\BeeGame;
use BeeGame\Classes\GameBuilder;
use BeeGame\Contracts\GameBuilderInterface;

class GameBuilderSpec extends BeeGameSpec
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(GameBuilder::class);
    }

    public function it_implements_a_contract()
    {
        $this->shouldImplement(GameBuilderInterface::class);
    }

    public function it_extends_a_parent()
    {
        $this->shouldBeAnInstanceOf(BeeGame::class);
    }

    public function it_builds_game_conditions_from_dotenv()
    {
        $this->buildGameState()->shouldBeArray();
    }

    public function it_builds_game_conditions_with_game_params()
    {
        $this->buildGameState()->shouldHaveKey('game_params');
    }

    public function it_builds_game_conditions_with_game_over()
    {
        $this->buildGameState()->shouldHaveKey('game_over');
    }

    public function it_builds_game_conditions_with_play_array()
    {
        $this->buildGameState()->shouldHaveKey('play_array');
    }

    public function it_builds_game_conditions_with_last_shot()
    {
        $this->buildGameState()->shouldHaveKey('last_shot');
    }

    public function it_builds_game_params()
    {
        $this->buildGameParams()->shouldBeArray();
    }

    public function it_builds_game_params_with_queen_key()
    {
        $this->buildGameParams()->shouldHaveKey('queen');
    }

    public function it_builds_game_params_with_worker_key()
    {
        $this->buildGameParams()->shouldHaveKey('worker');
    }

    public function it_builds_game_params_with_drone_key()
    {
        $this->buildGameParams()->shouldHaveKey('drone');
    }

    public function it_makes_a_play_array_with_the_correct_bee_number()
    {
        $this->buildGameState()->shouldHaveArrayWithCount('play_array', 14);
    }
}
