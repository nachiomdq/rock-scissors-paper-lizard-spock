<?php
namespace App\Src;

use App\Src\MoveClass;
use App\Helpers\HelperClass;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WinCalculatorClass extends MoveClass
{

    private $userMove;
    private $cpuMove;
    private $winnersRelation;
    protected $moveClass;

    const PLAYER_WON = 1;
    const CPU_WON = 2;
    const TIE = 0;

    public function __construct($userMove,$cpuMove)
    {
        parent::__construct();
        $this->userMove = $userMove;
        $this->cpuMove  = $cpuMove;
        $this->winnersRelation = $this->getWinnersRelation();

    }

    /**
     * Return string, who win the game ?.
     *
     * @return array
     */
    public function determineWinner()
    {
        $helper = new HelperClass();
        $response = [];
        $userWon = isset($this->winnersRelation[$this->userMove][$this->cpuMove]);
        if ($userWon){
            $response = [
                "winner" => "user",
                "userMovement" => $helper->moveToString($this->getPossibleMoves(),$this->userMove),
                "cpuMovement" => $helper->moveToString($this->getPossibleMoves(),$this->cpuMove),
                "fullResponse" =>$this->winnersRelation[$this->userMove][$this->cpuMove]
            ];
        }

        $cpuWon = isset($this->winnersRelation[$this->cpuMove][$this->userMove]);
        if($cpuWon){
            $response = [
                "winner" => "cpu",
                "userMovement" => $helper->moveToString($this->getPossibleMoves(),$this->userMove),
                "cpuMovement" => $helper->moveToString($this->getPossibleMoves(),$this->cpuMove),
                "fullResponse" =>$this->winnersRelation[$this->cpuMove][$this->userMove]
            ];
        }

        if(empty($response)){

            $response = [
                "winner" => "tie",
                "userMovement" => $helper->moveToString($this->getPossibleMoves(),$this->userMove),
                "cpuMovement" => $helper->moveToString($this->getPossibleMoves(),$this->cpuMove),
            ];
        }

        return $response;

    }

}