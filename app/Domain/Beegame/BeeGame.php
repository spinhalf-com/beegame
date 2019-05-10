<?php
/**
 * Created by PhpStorm.
 * User: johnriordan
 * Date: 2019-05-09
 * Time: 18:58
 */
namespace BeeGame;
use BeeGame\Contracts\BeeGameInterface;
use Dotenv\Dotenv;

class BeeGame implements BeeGameInterface
{
    public function __construct()
    {
        $dotenv = Dotenv::create(__DIR__."/../../../");
        $dotenv->load();
    }
}