<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class UnniformIntDistributionTest extends DistributionTestCase
{
    public function testGenerate()
    {
        $distribution = new UniformIntDistribution(0, 10);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($this->engine);

            $this->assertInternalType('int', $n);
            $this->assertGreaterThanOrEqual(0, $n);
            $this->assertLessThanOrEqual(10, $n);
        }
    }
}
