<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\PiecewiseConstantDistribution;
use PHPUnit\Framework\TestCase;

class PiecewiseConstantDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $intervals = [0.0, 1.0, 10.0];
        $densities = [1.0, 0.0];
        $distribution = new PiecewiseConstantDistribution($intervals, $densities);

        $this->assertSame($intervals, $distribution->getIntervals());
        $this->assertSame($densities, $distribution->getDensities());
    }

    public function testGenerate(): void
    {
        $intervals = [0.0, 1.0, 10.0];
        $densities = [1.0, 0.0];
        $engine = $this->createIncrementalEngineMock(0, 999);
        $distribution = new PiecewiseConstantDistribution($intervals, $densities);

        for ($i = 0; $i < 500; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThanOrEqual(1.0, $n);
        }

        $intervals = [0.0, 1.0, 10.0];
        $densities = [0.0, 1.0];
        $distribution = new PiecewiseConstantDistribution($intervals, $densities);

        for ($i = 500; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(1.0, $n);
            $this->assertLessThanOrEqual(10.0, $n);
        }
    }
}
