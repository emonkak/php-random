<?php

namespace Emonkak\Random\Tests\Distribution;

abstract class AbstractDistributionTestCase extends \PHPUnit_Framework_TestCase
{
    public function createEngineMock($min, $max)
    {
        return new EngineMock($min, $max);
    }

    public function createBiasedEngineMock($min, $max, $n)
    {
        $engine = $this->getMockForAbstractClass('Emonkak\Random\\Engine\\AbstractEngine');
        $engine
            ->expects($this->any())
            ->method('min')
            ->willReturn($min);
        $engine
            ->expects($this->any())
            ->method('max')
            ->willReturn($max);
        $engine
            ->expects($this->any())
            ->method('next')
            ->willReturn($n);
        return $engine;
    }
}
