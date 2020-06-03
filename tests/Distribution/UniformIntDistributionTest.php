<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\UniformIntDistribution;
use PHPUnit\Framework\TestCase;

class UnniformIntDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $distribution = new UniformIntDistribution(0, 10);

        $this->assertSame(10, $distribution->getMax());
        $this->assertSame(0, $distribution->getMin());
    }

    public function testGenerate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new UniformIntDistribution(0, 10);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('int', $n);
            $this->assertGreaterThanOrEqual(0, $n);
            $this->assertLessThanOrEqual(10, $n);
        }
    }
}
