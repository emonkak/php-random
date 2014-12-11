<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Tests\Distribution;

class AbstractDistributionTest extends AbstractDistributionTestCase
{
    public function testIterate()
    {
        $engine = $this->createEngineMock();
        $distribution =
            $this->getMockForAbstractClass('Emonkak\Random\\Distribution\\AbstractDistribution');
        $distribution
            ->expects($this->any())
            ->method('generate')
            ->with($this->identicalTo($engine))
            ->will($this->returnValue(1234));

        $it = $distribution->iterate($engine);

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
        $engine = $this->createEngineMock();
        $distribution =
            $this->getMockForAbstractClass('Emonkak\Random\\Distribution\\AbstractDistribution');
        $distribution
            ->expects($this->any())
            ->method('generate')
            ->with($this->identicalTo($engine))
            ->will($this->returnValue(1234));

        $this->assertSame(1234, $distribution($engine));
    }
}
