<?php

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\PhpMT19937Engine;

class PhpMT19937EngineTest extends \PHPUnit_Framework_TestCase
{
    public function testNext()
    {
        $engine = new PhpMT19937Engine(12345678);

        $expectedResults = array(
            1614640687,
            1711027313,
            857485497,
            688176834,
            1386682158,
            412773096,
            813703253,
            898651287,
            2087374214,
            1382556330,
            1640700129,
            1863374167,
            1324097651,
            1923803667,
            676334965,
            853386222,
        );

        foreach ($expectedResults as $expectedResult) {
            $this->assertSame($expectedResult, $engine->next());
        }

        $x = 0;
        for ($i = 0; $i < 1024; $i++) {
            $x ^= $engine->next();
        }

        $this->assertSame(1571178311, $x);
    }
}
