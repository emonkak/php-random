<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\PiecewiseLinerDistribution;

class PiecewiseLinerDistributionTest extends AbstractDistributionTestCase
{
    public function testGetIntervals()
    {
        $intervals = array(0, 5, 10, 15);
        $densities = array(0, 1,  1,  0);
        $distribution = new PiecewiseLinerDistribution($intervals, $densities);

        $this->assertSame($intervals, $distribution->getIntervals());
    }

    public function testGetDensities()
    {
        $intervals = array(0, 5, 10, 15);
        $densities = array(0, 1,  1,  0);
        $distribution = new PiecewiseLinerDistribution($intervals, $densities);

        $this->assertSame($densities, $distribution->getDensities());
    }
    public function testGenerate()
    {
        $intervals = array(0, 5, 10, 15);
        $densities = array(0, 1,  1,  0);
        $engine = $this->createEngineMock(0, 99);
        $distribution = new PiecewiseLinerDistribution($intervals, $densities);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThanOrEqual(15.0, $n);
        }
    }
}
