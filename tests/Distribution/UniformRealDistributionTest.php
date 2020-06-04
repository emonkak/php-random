<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\UniformRealDistribution;
use PHPUnit\Framework\TestCase;

class UnniformRealDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $distribution = new UniformRealDistribution(0.0, 10.0);

        $this->assertSame(10.0, $distribution->getMax());
        $this->assertSame(0.0, $distribution->getMin());
    }

    public function testGenerate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new UniformRealDistribution(0.0, 10.0);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThan(10.0, $n);
        }
    }
}
