<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class AbstractDistributionTest extends DistributionTestCase
{
    public function testIterate()
    {
        $distribution =
            $this->getMockForAbstractClass('Random\\Distribution\\AbstractDistribution');
        $distribution
            ->expects($this->any())
            ->method('generate')
            ->with($this->identicalTo($this->engine))
            ->will($this->returnValue(1234));

        $it = $distribution->iterate($this->engine);

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
