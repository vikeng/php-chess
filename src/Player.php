<?php

namespace Chess;

use Chess\Board;
use Chess\PGN\Convert;
use Chess\PGN\Symbol;

/**
 * Player.
 *
 * Allows to play a chess game as a PGN movetext.
 *
 * @author Jordi Bassagañas
 * @license GPL
 */
class Player
{
    protected $board;

    protected $moves;

    public function __construct(string $movetext, Board $board = null)
    {
        $board ? $this->board = $board : $this->board = new Board();

        $this->moves = $this->extract($this->filter($movetext));
    }

    public function getBoard(): Board
    {
        return $this->board;
    }

    public function getMoves()
    {
        return $this->moves;
    }

    public function play(): Player
    {
        foreach ($this->getMoves() as $move) {
            $this->getBoard()->play(Convert::toStdObj(Symbol::WHITE, $move[0]));
            if (isset($move[1])) {
                $this->getBoard()->play(Convert::toStdObj(Symbol::BLACK, $move[1]));
            }
        }

        return $this;
    }

    protected function extract(string $movetext)
    {
        $moves = [];
        $pairs = preg_split('/[0-9]+\./', $movetext, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($pairs as $pair) {
            $moves[] = explode(' ', trim($pair));
        }

        return $moves;
    }

    protected function filter(string $movetext)
    {
        return str_replace(
            [
                Symbol::RESULT_WHITE_WINS,
                Symbol::RESULT_BLACK_WINS,
                Symbol::RESULT_DRAW,
                Symbol::RESULT_UNKNOWN,
            ],
            '',
            $movetext
        );
    }
}
