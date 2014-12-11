<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\KnuthBEngine;

class KnuthBEngineTest extends \PHPUnit_Framework_TestCase
{
    public function testNext()
    {
        $engine = new KnuthBEngine();
        $engine->discard(9999);
        $this->assertSame(1112339016, $engine->next());
    }
}
