<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class DircreteDistributionTest extends DistributionTestCase
{
    public function testGenerateEqually()
    {
        $probabilities = array(
            1 => 25,
            2 => 25,
            3 => 25,
            4 => 25,
        );

        $engine = $this->createEngineMock();
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

        $engine = $this->createEngineMock();
        $distribution = new DiscreteDistribution($probabilities);

        for ($i = 0; $i < 100; $i++) {
            $this->assertSame(1, $distribution->generate($engine));
        }
    }

    /**
     * @expectedException LogicException
     */
    public function testGenerateWithNegativeProbability()
    {
        $engine = $this->createEngineMock();
        $distribution = new DiscreteDistribution(array(-1));

        $this->assertNull($distribution->generate($engine));
    }
}
