<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\MT19937Engine;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\MT19937Engine
 */
class MT19937EngineTest extends TestCase
{
    public function testMin(): void
    {
        $engine = new MT19937Engine(12345678);

        $this->assertSame(0, $engine->min());
    }

    public function testMax(): void
    {
        $engine = new MT19937Engine(12345678);

        $this->assertSame(mt_getrandmax(), $engine->max());
    }

    public function testNext(): void
    {
        $engine = new MT19937Engine(12345678);

        $expectedResults = [
            527860569,
            1711027313,
            1280820687,
            688176834,
            770499160,
            412773096,
            813703253,
            898651287,
            52508912,
            757323740,
            511765911,
            274407457,
            833082629,
            1923803667,
            1461450755,
            1301698200,
        ];

        foreach ($expectedResults as $expectedResult) {
            $this->assertSame($expectedResult, $engine->next());
        }

        $x = 0;
        for ($i = 0; $i < 1024; $i++) {
            $x ^= $engine->next();
        }

        $this->assertSame(1612214270, $x);
    }
}
