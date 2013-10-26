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

class DistributionIterator implements \Iterator
{
    /**
     * @var AbstractEngine
     */
    private $engine;

    /**
     * @var AbstractDistribution
     */
    private $distribution;

    /**
     * @var float
     */
    private $current;

    /**
     * @var integer
     */
    private $tick;

    /**
     * @param AbstractEngine      $engine
     * @param AbstractDistribution $distribution
     */
    public function __construct(AbstractEngine $engine, AbstractDistribution $distribution)
    {
        $this->engine = $engine;
        $this->distribution = $distribution;
    }

    /**
     * @see \Iterator
     * @return integer
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * @see \Iterator
     * @return integer
     */
    public function key()
    {
        return $this->tick;
    }

    /**
     * @see \Iterator
     * @return void
     */
    public function next()
    {
        $this->current = $this->distribution->generate($this->engine);
        $this->tick++;
    }

    /**
     * @see \Iterator
     * @return void
     */
    public function rewind()
    {
        $this->current = $this->distribution->generate($this->engine);
        $this->tick = 0;
    }

    /**
     * @see \Iterator
     * @return boolean
     */
    public function valid()
    {
        return true;
    }
}
