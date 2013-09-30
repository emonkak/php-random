<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

abstract class Engine implements \IteratorAggregate
{
    /**
     * @return boolean
     */
    abstract public function canReset();

    /**
     * @see    \IteratorAggregate
     * @return \Iterator
     */
    public function getIterator()
    {
        return new EngineIterator($this);
    }

    /**
     * Returns the maximum number that will be generated.
     *
     * @return integer
     */
    abstract public function maximum();

    /**
     * Returns the minimum number that will be generated.
     *
     * @return integer
     */
    abstract public function minimum();

    /**
     * Returns a random number.
     *
     * @return integer
     */
    abstract public function next();

    /**
     * Returns a random number of between 0.0 and 1.0.
     *
     * @return float
     */
    public function nextDouble()
    {
        return $this->next() / ($this->maximum() - $this->minimum() + 1.0);
    }

    /**
     * Initialize the state of the random number generator.
     *
     * @return void
     */
    abstract public function reset();
}
