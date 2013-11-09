<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class BinomialDistributionTest extends DistributionTestCase
{
    public function testGenerate()
    {
        $engine = $this->createEngineMock();
        $distribution = new BinomialDistribution(10, 1);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('int', $n);
            $this->assertSame(10, $n);
        }
    }
}
