<?php
declare(strict_types=1);
use App\GameClass;
use App\Src\MoveClass;
use App\Src\WinCalculatorClass;
use PHPUnit\Framework\TestCase;


class MainClassTest extends TestCase
{
    private $app;
    private $output;
    private $moveClass;
    private $winCalculatorClass;

    protected function setUp()
    {
        $this->moveClass= new MoveClass();
    }

    public function testTie()
    {

        $this->moveClass->setCpuMove("Roca");
        $this->moveClass->setMove("Roca");

        #Get moves
        $userMove = $this->moveClass->getMove();
        $cpuMove  = $this->moveClass->getCpuMove();

        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();

        $this->assertEquals("tie",$response['winner']);


    }

    public function testLizardBeatsPaper()
    {

        $this->moveClass->setCpuMove("Lagartija");
        $this->moveClass->setMove("Papel");

        #Get moves
        $userMove = $this->moveClass->getMove();
        $cpuMove  = $this->moveClass->getCpuMove();

        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();
        $this->assertEquals("cpu",$response['winner']);


    }

    public function testSpockBeatsScissors()
    {

        $this->moveClass->setCpuMove("Spock");
        $this->moveClass->setMove("Tijeras");

        #Get moves
        $userMove = $this->moveClass->getMove();
        $cpuMove  = $this->moveClass->getCpuMove();

        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();
        $this->assertEquals("cpu",$response['winner']);


    }
    public function testScissorsBeatLizard()
    {

        $this->moveClass->setCpuMove("Tijeras");
        $this->moveClass->setMove("Lagartija");

        #Get moves
        $userMove = $this->moveClass->getMove();
        $cpuMove  = $this->moveClass->getCpuMove();

        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();
        $this->assertEquals("cpu",$response['winner']);


    }
    public function testPaperBeatsRock()
    {

        $this->moveClass->setCpuMove("Papel");
        $this->moveClass->setMove("Roca");

        #Get moves
        $userMove = $this->moveClass->getMove();
        $cpuMove  = $this->moveClass->getCpuMove();

        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();
        $this->assertEquals("cpu",$response['winner']);


    }

    public function testRockBeatsLizard()
    {

        $this->moveClass->setCpuMove("Lagartija");
        $this->moveClass->setMove("Roca");

        #Get moves
        $userMove = $this->moveClass->getMove();
        $cpuMove  = $this->moveClass->getCpuMove();

        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();
        $this->assertEquals("user",$response['winner']);


    }

    public function testSpockBeatsRock()
    {

        $this->moveClass->setCpuMove("Spock");
        $this->moveClass->setMove("Roca");

        #Get moves
        $userMove = $this->moveClass->getMove();
        $cpuMove  = $this->moveClass->getCpuMove();

        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();
        $this->assertEquals("cpu",$response['winner']);


    }


    public function testPickMoveNotEmpty()
    {
        $helper = new App\Helpers\HelperClass();
        $this->moveClass->setCpuMove("Spock",true);

        $this->assertContains(strtolower($this->moveClass->getCpuMove()),$this->moveClass->getPossibleMoves());
    }



}