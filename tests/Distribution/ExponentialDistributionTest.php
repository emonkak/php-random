<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\ExponentialDistribution;

class ExponentialDistributionTest extends AbstractDistributionTestCase
{
    public function testGetLambda()
    {
        $distribution = new ExponentialDistribution(1.0);

        $this->assertSame(1.0, $distribution->getLambda());
    }

    public function testGenerate()
    {
        $engine = $this->createEngineMock(0, 99);
        $distribution = new ExponentialDistribution(1.0);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
