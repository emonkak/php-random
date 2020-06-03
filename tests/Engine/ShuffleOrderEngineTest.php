<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\EngineInterface;
use Emonkak\Random\Engine\ShuffleOrderEngine;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\ShuffleOrderEngine
 */
class ShuffleOrderEngineTest extends TestCase
{
    /**
     * @var EngineInterface
     */
    private $engine;

    public function setUp(): void
    {
        $this->engine = $this->getMockForAbstractClass(EngineInterface::class);
    }

    public function testMin(): void
    {
        $this->engine
            ->expects($this->once())
            ->method('min')
            ->willReturn(0);

        $engine = new ShuffleOrderEngine($this->engine, 8);

        $this->assertSame(0, $engine->min());
    }

    public function testMax(): void
    {
        $this->engine
            ->expects($this->once())
            ->method('max')
            ->willReturn(PHP_INT_MAX);

        $engine = new ShuffleOrderEngine($this->engine, 8);

        $this->assertSame(PHP_INT_MAX, $engine->max());
    }

    public function testNext(): void
    {
        $this->engine
            ->expects($this->any())
            ->method('max')
            ->willReturn(4);
        $this->engine
            ->expects($this->any())
            ->method('min')
            ->willReturn(1);
        $this->engine
            ->expects($this->any())
            ->method('next')
            ->will($this->onConsecutiveCalls(1, 2, 3, 4, 1, 2, 3, 4, 1));

        $engine = new ShuffleOrderEngine($this->engine, 4);

        for ($i = 0; $i < 4; $i++) {
            $this->assertContains($engine->next(), [1, 2, 3, 4]);
        }
    }
}
