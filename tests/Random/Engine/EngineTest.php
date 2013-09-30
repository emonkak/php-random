<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class EngineTest extends \PHPUnit_Framework_TestCase
{
    public function testGetIterator()
    {
        $engine = $this->getMockForAbstractClass('Random\\Engine\\Engine');

        $this->assertInstanceOf('IteratorAggregate', $engine);
        $this->assertInstanceOf('Iterator', $engine->getIterator());
    }
}
