<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class MinstdRandTest extends \PHPUnit_Framework_TestCase
{
    public function testNext()
    {
        $engine = new MinstdRandEngine();
        $engine->discard(9999);
        $this->assertSame(399268537, $engine->next());
    }
}
