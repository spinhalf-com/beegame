<?php
/**
 * Created by PhpStorm.
 * User: johnriordan
 * Date: 2019-05-09
 * Time: 20:14
 */

namespace spec\BeeGame;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use BeeGame\BeeGame;
use BeeGame\Contracts\BeeGameInterface;

class BeeGameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BeeGame::class);
    }

    function it_implements_a_contract()
    {
        $this->shouldImplement(BeeGameInterface::class);
    }
}
