<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Tests\Engine;

class MinstdRand0Test extends \PHPUnit_Framework_TestCase
{
    public function testNext()
    {
        $engine = new MinstdRand0Engine();
        $engine->discard(9999);
        $this->assertSame(1043618065, $engine->next());
    }
}
