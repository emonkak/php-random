<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\LogNormalDistribution;

class LogNormalDistributionTest extends AbstractDistributionTestCase
{
    public function testGenerate()
    {
        $engine = $this->createEngineMock();
        $distribution = new LogNormalDistribution(0, 1);

        for ($i = 100; $i--;) {
            $n = $distribution->generate($engine);

            $this->assertInternalType('float', $n);
            $this->assertGreaterThanOrEqual(0, $n);
        }
    }
}
