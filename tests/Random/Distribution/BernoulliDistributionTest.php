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
    public function testGenerateItAlwaysTrue()
    {
        $engine = $this->createEngineMock();
        $distribution = new BernoulliDistribution(1.0);

        for ($i = 100; $i--;) {
            $this->assertTrue($distribution->generate($engine));
        }
    }

    public function testGenerateItAlwaysFalse()
    {
        $engine = $this->createEngineMock();
        $distribution = new BernoulliDistribution(0.0);

        for ($i = 100; $i--;) {
            $this->assertFalse($distribution->generate($engine));
        }
    }
}
