<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\BernoulliDistribution;
use PHPUnit\Framework\TestCase;

class BernoulliDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $distribution = new BernoulliDistribution(1.0);

        $this->assertSame(1.0, $distribution->getP());
    }

    public function testGenerateReturnsTrue(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new BernoulliDistribution(1.0);

        for ($i = 0; $i < 100; $i++) {
            $this->assertTrue($distribution->generate($engine), $i . 'th');
        }
    }

    public function testGenerateReturnsFalse(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new BernoulliDistribution(0.0);

        for ($i = 0; $i < 100; $i++) {
            $this->assertFalse($distribution->generate($engine), $i . 'th');
        }
    }
}
