<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

use Random\Distribution\UniformIntDistribution;

class MT19937EngineTest extends \PHPUnit_Framework_TestCase
{
    const SUPPLY_OF_SEED = 16;

    const NUMBER_OF_TRIALS = 1024;

    public function testCanReset()
    {
        $engine = new MT19937Engine();

        $this->assertTrue($engine->canReset());
    }

    public function testMaximum()
    {
        $engine = new MT19937Engine();

        $this->assertSame(mt_getrandmax(), $engine->maximum());
    }

    public function testMinimum()
    {
        $engine = new MT19937Engine();

        $this->assertSame(0, $engine->minimum());
    }

    /**
     * @dataProvider seedProvider
     */
    public function testNext($seed)
    {
        $engine = new MT19937Engine($seed);

        mt_srand($seed);

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $this->assertSame(mt_rand(), $engine->next());
        }
    }

    /**
     * @dataProvider seedProvider
     */
    public function testNextDouble($seed)
    {
        $engine = new MT19937Engine($seed);

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $n = $engine->nextDouble();

            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThan(1.0, $n);
        }
    }

    public function testReset()
    {
        $engine = new MT19937Engine(12345);

        $xs = [];
        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $xs[$i] = $engine->next();
        }

        $engine->reset();

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $this->assertSame($xs[$i], $engine->next());
        }
    }

    /**
     * @dataProvider seedProvider
     */
    public function testUniformIntDistribution($seed)
    {
        $engine = new MT19937Engine($seed);
        $distribution = new UniformIntDistribution(0, 1234);

        mt_srand($seed);

        for ($i = 0; $i < self::NUMBER_OF_TRIALS; $i++) {
            $this->assertSame(mt_rand(0, 1234), $distribution->generate($engine));
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
