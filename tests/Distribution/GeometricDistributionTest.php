<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\GeometricDistribution;

class GeometricDistributionTest extends AbstractDistributionTestCase
{
    public function testGetBeta()
    {
        $distribution = new GeometricDistribution(0.5);

        $this->assertSame(0.5, $distribution->getP());
    }

    public function testGenerate()
    {
        $engine = $this->createEngineMock(0, 99);
        $distribution = new GeometricDistribution(0.5);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('integer', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
