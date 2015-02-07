<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\MTRandWrapper;

class MTRandWrapperTest extends \PHPUnit_Framework_TestCase
{
    public function testMax()
    {
        $engine = new MTRandWrapper();

        $this->assertSame(mt_getrandmax(), $engine->max());
    }

    public function testMin()
    {
        $engine = new MTRandWrapper();

        $this->assertSame(0, $engine->min());
    }

    public function testNext()
    {
        $engine = new MTRandWrapper();

        for ($i = 0; $i < 1000; $i++) {
            $n = $engine->next();

            $this->assertGreaterThanOrEqual($engine->min(), $n);
            $this->assertLessThanOrEqual($engine->max(), $n);
        }
    }

    public function testGetIterator()
    {
        mt_srand(1234);

        $engine = new MTRandWrapper();
        $xs = iterator_to_array(
            new \LimitIterator($engine->getIterator(), 0, 100),
            false
        );

        mt_srand(1234);

        $engine = new MTRandWrapper();
        $ys = iterator_to_array(
            new \LimitIterator($engine->getIterator(), 0, 100),
            false
        );

        $this->assertSame($xs, $ys);
    }
}
