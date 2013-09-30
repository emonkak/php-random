<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class XorShiftEngineTest extends \PHPUnit_Framework_TestCase
{
    const SUPPLY_OF_SEED = 128;

    const NUMBER_OF_TRIALS = 128;

    public function testCanReset()
    {
        $engine = new XorShift128Engine();

        $this->assertTrue($engine->canReset());
    }

    public function testMaximum()
    {
        $engine = new XorShift128Engine();

        $this->assertSame(0xffffffff, $engine->maximum());
    }

    public function testMinimum()
    {
        $engine = new XorShift128Engine();

        $this->assertSame(0, $engine->minimum());
    }

    /**
     * @dataProvider seedProvider
     */
    public function testNext($seed)
    {
        $engine = new XorShift128Engine($seed);

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $n = $engine->next();

            $this->assertGreaterThanOrEqual($engine->minimum(), $n);
            $this->assertLessThanOrEqual($engine->maximum(), $n);
        }
    }

    /**
     * @dataProvider seedProvider
     */
    public function testNextDouble($seed)
    {
        $engine = new XorShift128Engine($seed);

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $n = $engine->nextDouble();

            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThan(1.0, $n);
        }
    }

    public function testReset()
    {
        $engine = new XorShift128Engine(12345);

        $xs = [];
        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $xs[$i] = $engine->next();
        }

        $engine->reset();

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $this->assertSame($xs[$i], $engine->next());
        }
    }

    public function seedProvider()
    {
        return array_map(
            function($xs) { return array($xs); },
            range(0, PHP_INT_MAX, (int) (PHP_INT_MAX / self::SUPPLY_OF_SEED))
        );
    }
}
