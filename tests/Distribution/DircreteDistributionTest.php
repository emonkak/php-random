<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\DiscreteDistribution;
use PHPUnit\Framework\TestCase;

class DircreteDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testConstructor(): void
    {
        $probabilities = [
            1 => 25,
            2 => 25,
            3 => 25,
            4 => 25,
        ];

        $distribution = new DiscreteDistribution($probabilities);

        $this->assertSame($probabilities, $distribution->getProbabilities());
    }

    public function testGenerateEqually(): void
    {
        $probabilities = [
            1 => 25,
            2 => 25,
            3 => 25,
            4 => 25,
        ];

        $engine = $this->createIncrementalEngineMock(0, 99);
        $distribution = new DiscreteDistribution($probabilities);

        $seenIndexes = [];
        $avaliableKeys = array_keys($probabilities);

        for ($i = 0; $i < 100; $i++) {
            $j = $distribution->generate($engine);
            $seenIndexes[$j] = 1;
            $this->assertContains($j, $avaliableKeys);
        }

        $this->assertCount(count($probabilities), $seenIndexes);
    }

    public function testGenerateInequally(): void
    {
        $probabilities = [
            0 => 0,
            1 => 100,
            2 => 100,
        ];

        $engine = $this->createFixedEngineMock(0, 99, 0);
        $distribution = new DiscreteDistribution($probabilities);

        for ($i = 0; $i < 100; $i++) {
            $this->assertSame(1, $distribution->generate($engine));
        }
    }
}
