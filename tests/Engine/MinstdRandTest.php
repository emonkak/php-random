<?php

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\MinstdRandEngine;

class MinstdRandTest extends \PHPUnit_Framework_TestCase
{
    public function testNext()
    {
        $engine = new MinstdRandEngine(1);
        $engine->discard(9999);
        $this->assertSame(399268537, $engine->next());
    }
}
