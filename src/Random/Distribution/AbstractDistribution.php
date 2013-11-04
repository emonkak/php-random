<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

use Random\Engine\AbstractEngine;

abstract class AbstractDistribution
{
    /**
     * @param AbstractEngine $engine
     * @return mixed
     */
    abstract public function generate(AbstractEngine $engine);

    /**
     * @param AbstractEngine $engine
     * @return \Iterator
     */
    public function iterate(AbstractEngine $engine)
    {
        return new DistributionIterator($engine, $this);
    }
}
