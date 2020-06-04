<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\BinomialDistribution;
use PHPUnit\Framework\TestCase;

class BinomialDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $distribution = new BinomialDistribution(10, 1);

        $this->assertSame(10, $distribution->getT());
        $this->assertSame(1.0, $distribution->getP());
    }

    public function testGenerate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new BinomialDistribution(10, 1);

        for ($i = 0; $i < 100; $i++) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('int', $n);
            $this->assertSame(10, $n);
        }
    }

    public function testGenerateReturnsZero(): void
    {
        $engine = $this->createNullEngineMock();
        $distribution = new BinomialDistribution(0, 0);
        $this->assertSame(0, $distribution->generate($engine));
    }
}
