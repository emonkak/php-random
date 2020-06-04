<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\ExponentialDistribution;
use PHPUnit\Framework\TestCase;

class ExponentialDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $distribution = new ExponentialDistribution(1.0);

        $this->assertSame(1.0, $distribution->getLambda());
    }

    public function testGenerate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new ExponentialDistribution(1.0);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
