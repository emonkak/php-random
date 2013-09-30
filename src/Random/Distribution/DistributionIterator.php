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

class DistributionIterator implements \Iterator
{
    /**
     * @var Engine
     */
    private $engine;

    /**
     * @var Distribution
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
     * @param Engine       $engine
     * @param Distribution $distribution
     */
    public function __construct(Engine $engine, Distribution $distribution)
    {
        $this->engine = $engine;
        $this->distribution = $distribution;
    }

    /**
     * @see    \Iterator
     * @return integer
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * @see    \Iterator
     * @return integer
     */
    public function key()
    {
        return $this->tick;
    }

    /**
     * @see    \Iterator
     * @return void
     */
    public function next()
    {
        $this->current = $this->distribution->generate($this->engine);
        $this->tick++;
    }

    /**
     * @see    \Iterator
     * @return void
     */
    public function rewind()
    {
        if ($this->tick !== null) {
            if (!$this->engine->canReset()) {
                throw new \LogicException('Cannot rewind ' . get_class($this->engine) . ' class.');
            }

            $this->engine->reset();
        }

        $this->tick = 0;
    }

    /**
     * @see    \Iterator
     * @return boolean
     */
    public function valid()
    {
        return true;
    }
}
