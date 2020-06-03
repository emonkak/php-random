<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\PiecewiseLinerDistribution;
use PHPUnit\Framework\TestCase;

class PiecewiseLinerDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $intervals = [0, 5, 10, 15];
        $densities = [0, 1,  1,  0];
        $distribution = new PiecewiseLinerDistribution($intervals, $densities);

        $this->assertSame($intervals, $distribution->getIntervals());
        $this->assertSame($densities, $distribution->getDensities());
    }

    public function testGenerate(): void
    {
        $intervals = [0, 5, 10, 15];
        $densities = [0, 1,  1,  0];
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new PiecewiseLinerDistribution($intervals, $densities);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0.0, $n);
            $this->assertLessThanOrEqual(15.0, $n);
        }
    }
}
