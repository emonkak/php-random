<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\MinstdRand0Engine;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\LinearCongruentialEngine
 * @covers \Emonkak\Random\Engine\MinstdRand0Engine
 */
class MinstdRand0Test extends TestCase
{
    public function testMin(): void
    {
        $engine = new MinstdRand0Engine(1);
        $this->assertSame(1, $engine->min());
    }

    public function testMax(): void
    {
        $engine = new MinstdRand0Engine(1);
        $this->assertSame(2147483646, $engine->max());
    }

    public function testNext(): void
    {
        $engine = new MinstdRand0Engine(1);
        $engine->discard(9999);
        $this->assertSame(1043618065, $engine->next());
    }
}
