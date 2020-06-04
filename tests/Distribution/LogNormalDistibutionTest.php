<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\LogNormalDistribution;
use PHPUnit\Framework\TestCase;

class LogNormalDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testGenerate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new LogNormalDistribution(0, 1);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
