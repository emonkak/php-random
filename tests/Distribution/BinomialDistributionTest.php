<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\BinomialDistribution;

class BinomialDistributionTest extends AbstractDistributionTestCase
{
    public function testGetT()
    {
        $distribution = new BinomialDistribution(10, 1);

        $this->assertSame(10, $distribution->getT());
    }

    public function testGetP()
    {
        $distribution = new BinomialDistribution(10, 1);

        $this->assertSame(1, $distribution->getP());
    }

    public function testGenerate()
    {
        $engine = $this->createEngineMock(0, 99);
        $distribution = new BinomialDistribution(10, 1);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('int', $n);
            $this->assertSame(10, $n);
        }
    }
}
