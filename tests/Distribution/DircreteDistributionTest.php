<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\DiscreteDistribution;

class DircreteDistributionTest extends AbstractDistributionTestCase
{
    public function testGetProbabilities()
    {
        $probabilities = array(
            1 => 25,
            2 => 25,
            3 => 25,
            4 => 25,
        );

        $distribution = new DiscreteDistribution($probabilities);

        $this->assertSame($probabilities, $distribution->getProbabilities());
    }

    public function testGenerateEqually()
    {
        $probabilities = array(
            1 => 25,
            2 => 25,
            3 => 25,
            4 => 25,
        );

        $engine = $this->createEngineMock(0, 99);
        $distribution = new DiscreteDistribution($probabilities);

        $seenIndexes = array();
        $avaliableKeys = array_keys($probabilities);

        for ($i = 0; $i < 100; $i++) {
            $j = $distribution->generate($engine);
            $seenIndexes[$j] = 1;
            $this->assertContains($j, $avaliableKeys);
        }

        $this->assertCount(count($probabilities), $seenIndexes);
    }

    public function testGenerateInequally()
    {
        $probabilities = array(
            1 => 100,
            2 => 0,
            3 => 0,
            4 => 0,
        );

        $engine = $this->createEngineMock(0, 99);
        $distribution = new DiscreteDistribution($probabilities);

        for ($i = 0; $i < 100; $i++) {
            $this->assertSame(1, $distribution->generate($engine));
        }
    }
}
