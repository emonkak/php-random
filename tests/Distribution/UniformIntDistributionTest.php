<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\UniformIntDistribution;

class UnniformIntDistributionTest extends AbstractDistributionTestCase
{
    public function testGetMax()
    {
        $distribution = new UniformIntDistribution(0, 10);

        $this->assertSame(10, $distribution->getMax());
    }

    public function testGetMin()
    {
        $distribution = new UniformIntDistribution(0, 10);

        $this->assertSame(0, $distribution->getMin());
    }

    public function testGenerate()
    {
        $engine = $this->createEngineMock();
        $distribution = new UniformIntDistribution(0, 10);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('int', $n);
            $this->assertGreaterThanOrEqual(0, $n);
            $this->assertLessThanOrEqual(10, $n);
        }
    }
}
