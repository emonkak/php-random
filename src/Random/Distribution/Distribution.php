<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

use Random\Engine\Engine;

abstract class Distribution
{
    /**
     * @param  Engine $engine
     * @return float
     */
    abstract public function generate(Engine $engine);

    /**
     * @param  Engine $engine
     * @return \Iterator
     */
    public function iterate(Engine $engine)
    {
        return new DistributionIterator($engine, $this);
    }
}
