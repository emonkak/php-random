<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class ExponentialDistributionTest extends DistributionTestCase
{
    public function testGetLambda()
    {
        $distribution = new ExponentialDistribution(1.0);

        $this->assertSame(1.0, $distribution->getLambda());
    }

    public function testGenerate()
    {
        $engine = $this->createEngineMock();
        $distribution = new ExponentialDistribution(1.0);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
