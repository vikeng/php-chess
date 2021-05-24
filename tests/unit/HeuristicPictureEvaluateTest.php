<?php

namespace Chess\Tests\Unit\Heuristic;

use Chess\Board;
use Chess\HeuristicPicture;
use Chess\PGN\Symbol;
use Chess\Tests\AbstractUnitTestCase;
use Chess\Tests\Sample\Opening\Benoni\BenkoGambit;

class HeuristicPictureEvaluateTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function evaluate_benko_gambit()
    {
        $board = (new BenkoGambit(new Board()))->play();

        $heuristicPicture = new HeuristicPicture($board->getMovetext());

        $evaluation = $heuristicPicture->evaluate();

        $expected = [
            Symbol::WHITE => 38.71,
            Symbol::BLACK => 24.3,
        ];

        $this->assertEquals($expected, $evaluation);
    }
}
