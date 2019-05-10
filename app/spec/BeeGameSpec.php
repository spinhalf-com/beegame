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
    private $beeTypes;
    private $hits;

    function __construct()
    {
        $this->beeTypes = ['QUEEN', 'WORKER', 'DRONE'];
        $this->hits = [8, 10, 12];
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(BeeGame::class);
    }

    public function it_implements_a_contract()
    {
        $this->shouldImplement(BeeGameInterface::class);
    }

    public function getMatchers() : array
    {
        return [
            'haveArrayWithCount' => function ($array, $index, $count = null) {
                return count($array[$index]) == $count ? true : false;
            },
            'haveArrayWithLastShotData' => function ($array, $index) {

                switch ($index) {
                    case 'bee_type' :
                        return in_array($array['last_shot']['bee_type'], $this->beeTypes);
                        break;
                    case 'points' :
                        return in_array($array['last_shot']['points'], $this->hits);
                        break;
                    default:
                        return false;
                }
            }
        ];
    }
}

