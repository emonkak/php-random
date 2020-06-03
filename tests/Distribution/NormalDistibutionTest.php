<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\NormalDistribution;
use PHPUnit\Framework\TestCase;

class NormalDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $distribution = new NormalDistribution(0, 1);

        $this->assertSame(0.0, $distribution->getMean());
        $this->assertSame(1.0, $distribution->getSigma());
    }

    public function testGenerate(): void
    {
        $mean = 0;
        $sigma = 1;
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new NormalDistribution($mean, $sigma);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual($mean - 7 * $sigma, $n);
            $this->assertLessThanOrEqual($mean + 7 * $sigma, $n);
        }
    }
}
