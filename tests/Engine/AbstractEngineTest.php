<?php

namespace Emonkak\Random\Tests\Engine;

class AbstractEngineTest extends \PHPUnit_Framework_TestCase
{
    public function testGetIterator()
    {
        $engine =
            $this->getMockForAbstractClass('Emonkak\Random\\Engine\\AbstractEngine');
        $engine
            ->expects($this->any())
            ->method('next')
            ->willReturn(1234);

        $this->assertInstanceOf('IteratorAggregate', $engine);

        $it = $engine->getIterator();

        $this->assertInstanceOf('Iterator', $it);

        $it->rewind();

        for ($i = 0; $i < 10; $i++) {
            $this->assertTrue($it->valid());
            $this->assertSame(1234, $it->current());
            $this->assertSame($i, $it->key());

            $it->next();
        }
    }

    public function testInvoke()
    {
        $engine =
            $this->getMockForAbstractClass('Emonkak\Random\\Engine\\AbstractEngine');
        $engine
            ->expects($this->any())
            ->method('next')
            ->willReturn(1234);

        $this->assertSame(1234, $engine());
    }

    public function testNextDouble()
    {
        $engine =
            $this->getMockForAbstractClass('Emonkak\Random\\Engine\\AbstractEngine');
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
            ->will(call_user_func_array(array($this, 'onConsecutiveCalls'), range(0, 99)));

        for ($i = 100; $i--;) {
            $result = $engine->nextDouble();
            $this->assertGreaterThanOrEqual(0.0, $result);
            $this->assertLessThan(1, $result);
        }
    }

    public function testNextDoubleBiased()
    {
        $engine =
            $this->getMockForAbstractClass('Emonkak\Random\\Engine\\AbstractEngine');
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
