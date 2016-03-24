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
            ->will($this->returnValue(1234));

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
            ->will($this->returnValue(1234));

        $this->assertSame(1234, $engine());
    }

    public function testNextDouble()
    {
        $engine =
            $this->getMockForAbstractClass('Emonkak\Random\\Engine\\AbstractEngine');
        $engine
            ->expects($this->any())
            ->method('max')
            ->will($this->returnValue(PHP_INT_MAX));
        $engine
            ->expects($this->any())
            ->method('min')
            ->will($this->returnValue(0));
        $engine
            ->expects($this->any())
            ->method('next')
            ->will($this->onConsecutiveCalls(0, PHP_INT_MAX));

        $this->assertEquals(0.0, $engine->nextDouble());
        $this->assertEquals(1.0, $engine->nextDouble());
    }
}
