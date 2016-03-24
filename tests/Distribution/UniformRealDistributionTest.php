<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\UniformRealDistribution;

class UnniformRealDistributionTest extends AbstractDistributionTestCase
{
    public function testGetMax()
    {
        $distribution = new UniformRealDistribution(0.0, 10.0);

        $this->assertSame(10.0, $distribution->getMax());
    }

    public function testGetMin()
    {
        $distribution = new UniformRealDistribution(0.0, 10.0);

        $this->assertSame(0.0, $distribution->getMin());
    }

    public function testGenerate()
    {
        $engine = $this->createEngineMock();
        $distribution = new UniformRealDistribution(0.0, 10.0);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThanOrEqual(10.0, $n);
        }
    }
}
