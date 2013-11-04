<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class LinearCongruentialEngine extends AbstractEngine
{
    const DEFAULT_SEED = 1;

    /**
     * @var integer
     */
    private $a;

    /**
     * @var integer
     */
    private $c;

    /**
     * @var integer
     */
    private $m;

    /**
     * @var integer
     */
    private $x;

    /**
     * @param integer $a
     * @param integer $c
     * @param integer $m
     */
    public function __construct($a, $c, $m, $s = self::DEFAULT_SEED)
    {
        $this->a = $a;
        $this->c = $c;
        $this->m = $m;
        $this->x = $s;
    }

    /**
     * {@inheritdoc}
     */
    public function max()
    {
        return $this->m;
    }

    /**
     * {@inheritdoc}
     */
    public function min()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return $this->x = ($this->a * $this->x + $this->c) % $this->m;
    }
}
