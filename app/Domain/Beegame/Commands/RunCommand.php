<?php
/**
 * Created by PhpStorm.
 * User: johnriordan
 * Date: 2019-05-09
 * Time: 17:10
 */
namespace BeeGame\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use BeeGame\Classes\GameRunner;
use BeeGame\Classes\GameBuilder;

class RunCommand extends Command
{
    public $gameRunner;
    protected $shotCount = 0;
    protected $commandName = 'beegame:run';
    protected $commandDescription = "Start off the Beegame";

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameOver = false;

        $gameBuilder = new GameBuilder();
        $gameState = $gameBuilder->buildGameState();
        $game = new GameRunner();

        while($gameOver === false) {

            $typed = $this->askQuestion($input, $output);

            $gameState = $this->hit($typed, $game, $gameState);

//            echo json_encode($gameState);

            if($gameState['game_over']) {
                $gameOver = true;
            }
        }
    }

    public function hit($command, $game, $gameState)
    {
        if($command != 'hit') {
            echo "You must type 'hit' to take a shot!" . PHP_EOL;
        } else {
            $gameState = $game->run($gameState);
            $this->renderResult($gameState);
        }
        return $gameState;
    }

    public function renderResult($gameState)
    {
        $beeType = $gameState['last_shot']['bee_type'];
        $points = $gameState['last_shot']['points'];
        $shotCount = $gameState['last_shot']['shot_count'];

        if($gameState['game_over']) {
            echo "Game Over! You took $shotCount shots to destroy the hive." . PHP_EOL;
        } else {
            echo "Direct Hit. You took $points hit points from a $beeType bee." . PHP_EOL;
        }
    }

    public function parseQuestion()
    {
        if($this->shotCount > 0) {
            $question = "Type 'hit' to take another shot.";
        } else {
            $question = "Type 'hit' to take a shot.";
        }
        return $question;
    }

    public function askQuestion($input, $output)
    {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion($this->parseQuestion(), false);

        $typed = $helper->ask($input, $output, $question);

        return 'hit';
    }
}