<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\BernoulliDistribution;

class BernoulliDistributionTest extends AbstractDistributionTestCase
{
    public function testGetP()
    {
        $distribution = new BernoulliDistribution(1.0);

        $this->assertSame(1.0, $distribution->getP());
    }

    public function testGenerateItAlwaysTrue()
    {
        $engine = $this->createEngineMock();
        $distribution = new BernoulliDistribution(1.0);

        for ($i = 100; $i--;) {
            $this->assertTrue($distribution->generate($engine));
        }
    }

    public function testGenerateItAlwaysFalse()
    {
        $engine = $this->createEngineMock();
        $distribution = new BernoulliDistribution(0.0);

        for ($i = 100; $i--;) {
            $this->assertFalse($distribution->generate($engine));
        }
    }
}
