<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Engine;

class ShuffleOrderEngine extends AbstractEngine
{
    /**
     * @var AbstractEngine
     */
    private $engine;

    /**
     * @var integer
     */
    private $k;

    /**
     * @var SplFixedArray
     */
    private $v;

    /**
     * @var integer
     */
    private $y;

    /**
     * @param AbstractEngine $engine
     * @param integer $k
     */
    public function __construct(AbstractEngine $engine, $k)
    {
        $this->engine = $engine;
        $this->k = $k;
        $this->v = new \SplFixedArray($k);

        for ($i = 0; $i < $k; $i++) {
            $this->v[$i] = $this->engine->next();
        }

        $this->y = $this->engine->next();
    }

    /**
     * {@inheritdoc}
     */
    public function max()
    {
        return $this->engine->max();
    }

    /**
     * {@inheritdoc}
     */
    public function min()
    {
        return $this->engine->min();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $min = $this->engine->min();
        $max = $this->engine->max();

        $i = (int) ($this->k * ($this->y - $min) / ($max - $min + 1));

        $this->y = $this->v[$i];
        $this->v[$i] = $this->engine->next();

        return $this->y;
    }

    /**
     * {@inheritdoc}
     */
    public function seed($seed)
    {
        $this->engine->seed($seed);
    }
}
