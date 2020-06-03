<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\MTRandWrapper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\MTRandWrapper
 */
class MTRandWrapperTest extends TestCase
{
    public function testMin(): void
    {
        $engine = new MTRandWrapper();

        $this->assertSame(0, $engine->min());
    }

    public function testMax(): void
    {
        $engine = new MTRandWrapper();

        $this->assertSame(mt_getrandmax(), $engine->max());
    }

    public function testNext(): void
    {
        $engine = new MTRandWrapper();

        for ($i = 0; $i < 1000; $i++) {
            $n = $engine->next();

            $this->assertGreaterThanOrEqual($engine->min(), $n);
            $this->assertLessThanOrEqual($engine->max(), $n);
        }
    }

    public function testGetIterator(): void
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
