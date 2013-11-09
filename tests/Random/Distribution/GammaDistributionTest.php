<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class GammaDistributionTest extends DistributionTestCase
{
    public function testGenerate()
    {
        $engine = $this->createEngineMock();
        $distribution = new GammaDistribution(1.0, 1.0);

        for ($i = 25; $i--;) {
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
