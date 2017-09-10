<?php

namespace App\Src;


class MoveClass
{

    //Integer constants
    const ROCK     = 0;
    const PAPER    = 1;
    const SCISSORS = 2;
    const LIZARD   = 3;
    const SPOCK    = 4;
    private $moves = [
        self::ROCK     => 'roca',
        self::PAPER    => 'papel',
        self::SCISSORS => 'tijeras',
        self::LIZARD   => 'lagartija',
        self::SPOCK    => 'spock'
    ];

    /**
     * Win schemas
     *
     * @var array
     */
    private $winnersRelation = [
        self::ROCK     => [
            self::SCISSORS => 'Roca rompe las tijeras',
            self::LIZARD   => 'Roca aplasta a lagartija'
        ],
        self::PAPER    => [
            self::ROCK  => 'Papel cubre a la roca',
            self::SPOCK => 'Papel refuta a Spock'
        ],
        self::SCISSORS => [
            self::PAPER  => 'Tijeras cortan papel',
            self::LIZARD => 'Tijeras decapita a lagartija :('
        ],
        self::LIZARD   => [
            self::SPOCK => 'Lagartija envenena a Spock',
            self::PAPER => 'Lagartija se come al papel'
        ],
        self::SPOCK    => [
            self::SCISSORS => 'Spock golpea tijeras',
            self::ROCK     => 'Spock vaporiza las piedras'
        ]
    ];
    private $move;
    private $cpuMove;


    public function __construct()
    {

    }

    public  function getPossibleMoves()
    {
        return $this->moves;
    }
    public function getWinnersRelation()
    {
        return $this->winnersRelation;
    }
    public function getMove()
    {
        return $this->move;
    }
    public function setMove($move = null, $asString = false)
    {
        $this->move = $this->pickMove($move, $asString = false);
    }
    public function setCpuMove($move = null, $asString = false)
    {
        $this->cpuMove =  $this->pickMove($move, $asString);

    }

    public function getCpuMove()
    {
        return $this->cpuMove;
    }

    /**
     * Returns random integer as one of the valid move.
     * @param $move
     * @return int
     */
    protected function pickMove($move= null, $asString)
    {


        if ($asString){
            if (in_array(strtolower(trim($move)),$this->getPossibleMoves())){
                return strtolower(trim($move));


            } else{
                throw new \RuntimeException('No se encuentra el movimiento solicitado ');
            }

        }
        if (!is_null($move)){
            try {
                if (in_array(strtolower(trim($move)),$this->getPossibleMoves())){
                    return  array_search(strtolower(trim($move)), $this->getPossibleMoves());

                } else{
                    throw new \RuntimeException('No se encuentra el movimiento solicitado ');
                }
            } catch (\RuntimeException $e) {
                throw new \RuntimeException($e->getMessage());
            }

        }
        return array_rand($this->moves);
    }
}