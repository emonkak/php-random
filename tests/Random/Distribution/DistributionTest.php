<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class DistributionTest extends \PHPUnit_Framework_TestCase
{
    public function testIterate()
    {
        $engine = $this->getMockForAbstractClass('Random\\Engine\\Engine');
        $distribution = $this->getMockForAbstractClass('Random\\Distribution\\Distribution');

        $this->assertInstanceOf('Iterator', $distribution->iterate($engine));
    }
}
