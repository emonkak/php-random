<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class UnniformRealDistributionTest extends DistributionTestCase
{
    public function testGenerate()
    {
        $distribution = new UniformRealDistribution(0.0, 10.0);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($this->engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThanOrEqual(10.0, $n);
        }
    }
}
