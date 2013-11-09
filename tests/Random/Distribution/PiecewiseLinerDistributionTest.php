<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class PiecewiseLinerDistributionTest extends DistributionTestCase
{
    public function testGenerate()
    {
        $intervals = array(0, 5, 10, 15);
        $densities = array(0, 1,  1,  0);
        $engine = $this->createEngineMock();
        $distribution = new PiecewiseLinerDistribution($intervals, $densities);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThanOrEqual(15.0, $n);
        }
    }
}
