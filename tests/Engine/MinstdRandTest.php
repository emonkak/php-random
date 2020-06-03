<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\MinstdRandEngine;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\LinearCongruentialEngine
 * @covers \Emonkak\Random\Engine\MinstdRandEngine
 */
class MinstdRandTest extends TestCase
{
    public function testMin(): void
    {
        $engine = new MinstdRandEngine(1);
        $this->assertSame(1, $engine->min());
    }

    public function testMax(): void
    {
        $engine = new MinstdRandEngine(1);
        $this->assertSame(2147483646, $engine->max());
    }

    public function testNext(): void
    {
        $engine = new MinstdRandEngine(1);
        $engine->discard(9999);
        $this->assertSame(399268537, $engine->next());
    }
}
