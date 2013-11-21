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
    const SUPPLY_OF_SEED = 8;

    const NUMBER_OF_TRIALS = 128;

    public function testMax()
    {
        $engine = new XorShift128Engine();

        $this->assertSame(0x7fffffff, $engine->max());
    }

    public function testMin()
    {
        $engine = new XorShift128Engine();

        $this->assertSame(0, $engine->min());
    }

    /**
     * @dataProvider seedProvider
     */
    public function testNext($seed)
    {
        $engine = new XorShift128Engine($seed);

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $n = $engine->next();

            $this->assertGreaterThanOrEqual($engine->min(), $n);
            $this->assertLessThanOrEqual($engine->max(), $n);
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

    public function seedProvider()
    {
        return array_map(
            function($xs) { return array($xs); },
            range(0, PHP_INT_MAX, (int) (PHP_INT_MAX / self::SUPPLY_OF_SEED))
        );
    }
}
