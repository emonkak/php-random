<?php

namespace Emonkak\Random\Tests\Distribution;

abstract class AbstractDistributionTestCase extends \PHPUnit_Framework_TestCase
{
    public function createEngineMock($min, $max)
    {
        return new EngineMock($min, $max);
    }
}
