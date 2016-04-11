<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\NormalDistribution;

class NormalDistributionTest extends AbstractDistributionTestCase
{
    public function testGetMean()
    {
        $distribution = new NormalDistribution(0, 1);

        $this->assertSame(0, $distribution->getMean());
    }

    public function testGetSigma()
    {
        $distribution = new NormalDistribution(0, 1);

        $this->assertSame(1, $distribution->getSigma());
    }

    public function testGenerate()
    {
        $mean = 0;
        $sigma = 1;
        $engine = $this->createEngineMock(0, 99);
        $distribution = new NormalDistribution($mean, $sigma);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual($mean - 7 * $sigma, $n);
            $this->assertLessThanOrEqual($mean + 7 * $sigma, $n);
        }
    }
}
