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
        $probabilities = [
            1 => 25,
            2 => 25,
            3 => 25,
            4 => 25,
        ];
        $distribution = new DiscreteDistribution($probabilities);

        $seenIndexes = [];
        $avaliableKeys = array_keys($probabilities);

        for ($i = 0; $i < 100; $i++) {
            $j = $distribution->generate($this->engine);
            $seenIndexes[$j] = 1;
            $this->assertContains($j, $avaliableKeys);
        }

        $this->assertCount(count($probabilities), $seenIndexes);
    }

    public function testGenerateInequally()
    {
        $probabilities = [
            1 => 100,
            2 => 0,
            3 => 0,
            4 => 0,
        ];
        $distribution = new DiscreteDistribution($probabilities);

        for ($i = 0; $i < 100; $i++) {
            $this->assertSame(1, $distribution->generate($this->engine));
        }
    }

    public function testGenerateWhenEmpty()
    {
        $distribution = new DiscreteDistribution([]);

        $this->assertNull($distribution->generate($this->engine));
    }
}
