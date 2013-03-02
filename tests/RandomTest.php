<?php

use Random\MersenneTwister;
use Random\MersenneTwisterNative;
use Random\XorShift;

class RandomTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testGenerateWithMersenneTwister($seed)
    {
        $random = new MersenneTwister($seed);
        mt_srand($seed);

        for ($i = 0; $i < 1000; $i++) {
            $this->assertEquals(mt_rand(), $random->generate());
        }
    }

    /**
     * @dataProvider provider
     */
    public function testGenerateWithMersenneTwisterNative($seed)
    {
        $random1 = new MersenneTwister($seed);
        $random2 = new MersenneTwisterNative($seed);

        for ($i = 0; $i < 1000; $i++) {
            $this->assertEquals($random1->generate(), $random2->generate());
        }
    }

    /**
     * @dataProvider provider
     */
    public function testRangeWithMersenneTwister($seed)
    {
        $random = new MersenneTwister($seed);
        mt_srand($seed);

        for ($i = 0; $i < 1000; $i++) {
            $x = mt_rand(0, 10);
            $y = $random->range(0, 10);
            $this->assertEquals($x, $y);
        }

        for ($i = 0; $i < 1000; $i++) {
            $x = mt_rand(-10, 0);
            $y = $random->range(-10, 0);
            $this->assertEquals($x, $y);
        }
    }

    public function testWithoutInitialSeed()
    {
        $random = new MersenneTwister();

        $xs = array();
        for ($i = 0; $i < 100; $i++) {
            $xs[] = $random->generate();
        }

        $ys = array();
        for ($i = 0; $i < 100; $i++) {
            $ys[] = $random->generate();
        }

        $this->assertNotEquals($xs, $ys);
    }

    public function provider()
    {
        return array_map(function($xs) { return array($xs); },
                         range(-50, 50));
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
