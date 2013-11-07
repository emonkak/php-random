<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class PiecewiseConstantDistributionTest extends DistributionTestCase
{
    public function testGenerate()
    {
        $intervals = array(0.0, 1.0, 10.0);
        $densities = array(1.0, 0.0);
        $engine = $this->createEngineMock();
        $distribution = new PiecewiseConstantDistribution($intervals, $densities);

        for ($i = 500; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThanOrEqual(1.0, $n);
        }

        $intervals = array(0.0, 1.0, 10.0);
        $densities = array(0.0, 1.0);
        $distribution = new PiecewiseConstantDistribution($intervals, $densities);

        for ($i = 500; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(1.0, $n);
            $this->assertLessThanOrEqual(10.0, $n);
        }
    }
}
