<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class AbstractEngineTest extends \PHPUnit_Framework_TestCase
{
    public function testGetIterator()
    {
        $engine =
            $this->getMockForAbstractClass('Random\\Engine\\AbstractEngine');
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
}
