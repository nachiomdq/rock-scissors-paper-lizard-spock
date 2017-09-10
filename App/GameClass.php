<?php
namespace App;


use App\Src\WinCalculatorClass;
use App\Src\MoveClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameClass extends Command
{

    /**
     * Configuration.
     */
    protected function configure()
    {
        $this->setName('play')
            ->setDescription('Que comienze el juego...');
    }

    /**
     * Command execution.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */

    public function execute(InputInterface $input, OutputInterface $output)
    {
        #Initialize class
        $moveClass = new MoveClass();
        #Output and questions started
        $output->writeln('<info>Empieza el juego, beat me (Enter para aleatorio)!</info>');
        $output->writeln('');
        $output->writeln('<comment>Posibles movimientos: Roca, Papel, Tijeras, Lagartija, Spock</comment>');

        #Ask the question
        $helper = $this->getHelper('question');
        $question = new Question('Cual es tu movimiento?: ');
        $question->setMaxAttempts(1);

        $move = false;
        # Get a move as an integer.
        try {
            $move = $helper->ask($input, $output, $question);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException('Ese movimiento no es válido dude :(');
        }


        #Set User move
        $moveClass->setMove($move);
        #Set CPU move
        $moveClass->setCpuMove();

        $userMove = $moveClass->getMove();
        $cpuMove  = $moveClass->getCpuMove();
        #Start calculator class to determine winners
        $winCalculator = new WinCalculatorClass($userMove,$cpuMove);
        $response = $winCalculator->determineWinner();
        $this->getResults($output,$response);

    }

    public function getResults(OutputInterface $output,$response)
    {
        $output->writeln('Yo he jugado: ' . $response['cpuMovement']);
        $output->writeln('Tu has jugado: ' . $response['userMovement']);
        switch ($response['winner']){
            case "user":
                $output->writeln($response['fullResponse']);
                $output->writeln('<info>Tu ganas, damn it</info>!');
                break;
            case "cpu":
                $output->writeln($response['fullResponse']);
                $output->writeln('<error>Yo gano</error>!');
                break;
            case "tie":
                $output->writeln('<comment>Empate</comment>');
        }


    }
}