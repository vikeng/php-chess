<?php

namespace Chess\Tests\Unit\PGN\Validate;

use Chess\PGN\Symbol;
use Chess\PGN\Validate;
use Chess\Tests\AbstractUnitTestCase;

class ColorTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function green_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        Validate::color('green');
    }

    /**
     * @test
     */
    public function white()
    {
        $this->assertEquals(Symbol::WHITE, Validate::color(Symbol::WHITE));
    }

    /**
     * @test
     */
    public function black()
    {
        $this->assertEquals(Symbol::BLACK, Validate::color(Symbol::BLACK));
    }
}
