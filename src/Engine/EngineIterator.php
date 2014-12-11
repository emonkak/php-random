<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Engine;

class EngineIterator implements \Iterator
{
    /**
     * @var AbstractEngine
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
     * @param AbstractEngine $engine
     */
    public function __construct(AbstractEngine $engine)
    {
        $this->engine = $engine;
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
        $this->current = $this->engine->next();
        $this->tick++;
    }

    /**
     * @see \Iterator
     * @return void
     */
    public function rewind()
    {
        $this->current = $this->engine->next();
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
