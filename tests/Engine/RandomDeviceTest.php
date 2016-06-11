<?php

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\RandomDevice;

/**
 * @requires extension mcrypt
 */
class RandomDeviceTest extends \PHPUnit_Framework_TestCase
{
    public function testMax()
    {
        return $this->assertSame(0x7fffffff, (new RandomDevice())->max());
    }

    public function testMin()
    {
        return $this->assertSame(0, (new RandomDevice())->min());
    }

    public function testNext()
    {
        $engine = new RandomDevice();

        for ($i = 0; $i < 1000; $i++) {
            $n = $engine->next();

            $this->assertGreaterThanOrEqual($engine->min(), $n);
            $this->assertLessThanOrEqual($engine->max(), $n);
        }
    }
}
