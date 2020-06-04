<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\GammaDistribution;
use PHPUnit\Framework\TestCase;

class GammaDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $distribution = new GammaDistribution(0.75, 0.25);

        $this->assertSame(0.75, $distribution->getAlpha());
        $this->assertSame(0.25, $distribution->getBeta());
    }

    public function testGenerate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 74);
        $distribution = new GammaDistribution(1.0, 1.0);

        for ($i = 0; $i < 25; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }

        $distribution = new GammaDistribution(0.75, 0.25);

        for ($i = 25; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }

        $distribution = new GammaDistribution(7.5, 0.25);

        for ($i = 25; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
