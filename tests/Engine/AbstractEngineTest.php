<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\AbstractEngine;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\AbstractEngine
 */
class AbstractEngineTest extends TestCase
{
    public function testGetIterator(): void
    {
        $engine = $this->getMockForAbstractClass(AbstractEngine::class);
        $engine
            ->expects($this->any())
            ->method('next')
            ->willReturn(1234);

        $iterator = $engine->getIterator();

        $iterator->rewind();

        for ($i = 0; $i < 10; $i++) {
            $this->assertTrue($iterator->valid());
            $this->assertSame(1234, $iterator->current());
            $this->assertSame($i, $iterator->key());
            $iterator->next();
        }
    }

    public function testDiscard(): void
    {
        $engine = $this->getMockForAbstractClass(AbstractEngine::class);
        $engine
            ->expects($this->exactly(100))
            ->method('next');

        $engine->discard(100);
    }

    public function testNextDouble(): void
    {
        $engine = $this->getMockForAbstractClass(AbstractEngine::class);
        $engine
            ->expects($this->any())
            ->method('min')
            ->willReturn(0);
        $engine
            ->expects($this->any())
            ->method('max')
            ->willReturn(99);
        $engine
            ->expects($this->any())
            ->method('next')
            ->will($this->returnCallback(function() {
                return mt_rand(0, 99);
            }));

        for ($i = 0; $i < 100; $i++) {
            $result = $engine->nextDouble();
            $this->assertGreaterThanOrEqual(0.0, $result);
            $this->assertLessThan(1, $result);
        }
    }

    public function testNextDoubleFixed(): void
    {
        $engine = $this->getMockForAbstractClass(AbstractEngine::class);
        $engine
            ->expects($this->any())
            ->method('min')
            ->willReturn(0);
        $engine
            ->expects($this->any())
            ->method('max')
            ->willReturn(99);
        $engine
            ->expects($this->any())
            ->method('next')
            ->willReturn(99);

        for ($i = 100; $i--;) {
            $result = $engine->nextDouble();
            $this->assertGreaterThanOrEqual(0.0, $result);
            $this->assertLessThan(1, $result);
        }
    }
}
