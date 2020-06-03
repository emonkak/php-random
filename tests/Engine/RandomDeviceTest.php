<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\RandomDevice;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\RandomDevice
 */
class RandomDeviceTest extends TestCase
{
    public function testMin(): void
    {
        $engine = new RandomDevice();
        $this->assertSame(0, $engine->min());
    }

    public function testMax(): void
    {
        $engine = new RandomDevice();
        $this->assertSame(0x7fffffff, $engine->max());
    }

    public function testNext(): void
    {
        $engine = new RandomDevice();

        for ($i = 0; $i < 1000; $i++) {
            $n = $engine->next();

            $this->assertGreaterThanOrEqual($engine->min(), $n);
            $this->assertLessThanOrEqual($engine->max(), $n);
        }
    }
}
