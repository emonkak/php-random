<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class EngineIterator implements \Iterator
{
    /**
     * @var RandomEngine
     */
    private $engine;

    /**
     * @var integer
     */
    private $current;

    /**
     * @var integer
     */
    private $tick;

    /**
     * @param Engine $engine
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
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
        $this->current = $this->engine->next();
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
                throw new \LogicException('Cannot rewind the ' . get_class($this->engine) . ' class.');
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
