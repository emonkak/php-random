<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

class DistributionTestCase extends \PHPUnit_Framework_TestCase
{
    public function createEngineMock()
    {
        $engine =
            $this->getMockForAbstractClass('Random\\Engine\\AbstractEngine');

        $engine
            ->expects($this->any())
            ->method('next')
            ->will($this->returnCallback('mt_rand'));
        $engine
            ->expects($this->any())
            ->method('max')
            ->will($this->returnCallback('mt_getrandmax'));
        $engine
            ->expects($this->any())
            ->method('min')
            ->will($this->returnValue(0));

        return $engine;
    }
}
