<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class NormalDistributionTest extends DistributionTestCase
{
    public function testGenerate()
    {
        $meam = 0;
        $sigma = 1;
        $engine = $this->createEngineMock();
        $distribution = new NormalDistribution($meam, $sigma);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual($meam - 7 * $sigma, $n);
            $this->assertLessThanOrEqual($meam + 7 * $sigma, $n);
        }
    }
}
