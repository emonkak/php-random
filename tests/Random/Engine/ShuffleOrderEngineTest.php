<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class ShuffleOrderEngineTest extends \PHPUnit_Framework_TestCase
{
    private $engine;

    public function setUp()
    {
        $this->engine =
            $this->getMockForAbstractClass('Random\\Engine\\AbstractEngine');
    }

    public function testMax()
    {
        $this->engine
            ->expects($this->once())
            ->method('max')
            ->will($this->returnValue(PHP_INT_MAX));

        $engine = new ShuffleOrderEngine($this->engine, 8);

        $this->assertSame(PHP_INT_MAX, $engine->max());
    }

    public function testMin()
    {
        $this->engine
            ->expects($this->once())
            ->method('min')
            ->will($this->returnValue(0));

        $engine = new ShuffleOrderEngine($this->engine, 8);

        $this->assertSame(0, $engine->min());
    }

    public function testNext()
    {
        $this->engine
            ->expects($this->any())
            ->method('max')
            ->will($this->returnValue(4));
        $this->engine
            ->expects($this->any())
            ->method('min')
            ->will($this->returnValue(1));
        $this->engine
            ->expects($this->any())
            ->method('next')
            ->will($this->onConsecutiveCalls(1, 2, 3, 4, 1, 2, 3, 4, 1));

        $engine = new ShuffleOrderEngine($this->engine, 4);

        for ($i = 0; $i < 4; $i++) {
            $this->assertContains($engine->next(), [1, 2, 3, 4]);
        }
    }
}
