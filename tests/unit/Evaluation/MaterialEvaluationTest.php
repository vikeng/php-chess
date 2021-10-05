<?php

namespace Chess\Tests\Unit\Evaluation;

use Chess\Board;
use Chess\Evaluation\MaterialEvaluation;
use Chess\PGN\Symbol;
use Chess\Tests\AbstractUnitTestCase;
use Chess\Tests\Sample\Opening\RuyLopez\LucenaDefense as RuyLopezLucenaDefense;

class MaterialEvaluationTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function starting_position()
    {
        $board = new Board();

        $expected = [
            Symbol::WHITE => 40.06,
            Symbol::BLACK => 40.06,
        ];

        $mtlEvald = (new MaterialEvaluation($board))->evaluate();

        $this->assertEquals($expected, $mtlEvald);
    }

    /**
     * @test
     */
    public function ruy_lopez_lucena_defense()
    {
        $board = (new RuyLopezLucenaDefense(new Board()))->play();

        $expected = [
            Symbol::WHITE => 40.06,
            Symbol::BLACK => 40.06,
        ];

        $mtlEvald = (new MaterialEvaluation($board))->evaluate();

        $this->assertEquals($expected, $mtlEvald);
    }
}
