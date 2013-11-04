<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

abstract class AbstractEngine implements \IteratorAggregate
{
    /**
     * @see \IteratorAggregate
     * @return \Iterator
     */
    public function getIterator()
    {
        return new EngineIterator($this);
    }

    /**
     * Advances the internal state by z notches.
     *
     * @param integer $z
     */
    public function discard($z)
    {
        while ($z-- > 0) {
            $this->next();
        }
    }

    /**
     * Returns the maximum number that will be generated.
     *
     * @return integer
     */
    abstract public function max();

    /**
     * Returns the minimum number that will be generated.
     *
     * @return integer
     */
    abstract public function min();

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
        return $this->next() / ($this->max() - $this->min() + 1.0);
    }

    /**
     * Sets the initial seed.
     *
     * @param integer $seed
     */
    abstract public function seed($seed);
}
