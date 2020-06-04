<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\GeometricDistribution;
use PHPUnit\Framework\TestCase;

class GeometricDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testGetBeta(): void
    {
        $distribution = new GeometricDistribution(0.5);

        $this->assertSame(0.5, $distribution->getP());
    }

    public function testGenerate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new GeometricDistribution(0.5);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('int', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
