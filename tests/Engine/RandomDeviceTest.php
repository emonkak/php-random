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
        $engine = new RandomDevice();
        return $this->assertSame(0x7fffffff, $engine->max());
    }

    public function testMin()
    {
        $engine = new RandomDevice();
        return $this->assertSame(0, $engine->min());
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
