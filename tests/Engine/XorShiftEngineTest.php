<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\XorShift128Engine;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\XorShift128Engine
 */
class XorShiftEngineTest extends TestCase
{
    const SUPPLY_OF_SEED = 8;

    const NUMBER_OF_TRIALS = 128;

    public function testMin(): void
    {
        $engine = new XorShift128Engine(123456789, 362436069, 521288629, 88675123);

        $this->assertSame(0, $engine->min());
    }

    public function testMax(): void
    {
        $engine = new XorShift128Engine(123456789, 362436069, 521288629, 88675123);

        $this->assertSame(0x7fffffff, $engine->max());
    }

    /**
     * @dataProvider providerNext
     */
    public function testNext(int $seed): void
    {
        $engine = XorShift128Engine::from($seed);

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $n = $engine->next();

            $this->assertGreaterThanOrEqual($engine->min(), $n);
            $this->assertLessThanOrEqual($engine->max(), $n);
        }
    }

    /**
     * @dataProvider providerNext
     */
    public function testNextDouble(int $seed): void
    {
        $engine = XorShift128Engine::from($seed);

        for ($i = self::NUMBER_OF_TRIALS; $i--;) {
            $n = $engine->nextDouble();

            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThan(1.0, $n);
        }
    }

    public function providerNext(): array
    {
        return array_map(
            function($xs) { return [$xs]; },
            range(0, PHP_INT_MAX, (int) (PHP_INT_MAX / self::SUPPLY_OF_SEED))
        );
    }
}
