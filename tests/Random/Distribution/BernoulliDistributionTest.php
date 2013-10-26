<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class BernoulliDistributionTest extends DistributionTestCase
{
    public function testGenerate_AlwaysTrue()
    {
        $distribution = new BernoulliDistribution(1.0);

        for ($i = 100; $i--;) {
            $this->assertTrue($distribution->generate($this->engine));
        }
    }

    public function testGenerate_AlwaysFalse()
    {
        $distribution = new BernoulliDistribution(0.0);

        for ($i = 100; $i--;) {
            $this->assertFalse($distribution->generate($this->engine));
        }
    }
}
