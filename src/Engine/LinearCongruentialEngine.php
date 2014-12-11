<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Engine;

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
     * @param integer $x The seed number
     */
    public function __construct($a, $c, $m, $x)
    {
        $this->a = $a;
        $this->c = $c;
        $this->m = $m;
        $this->x = $x;
    }

    /**
     * {@inheritdoc}
     */
    public function max()
    {
        return $this->m - 1;
    }

    /**
     * {@inheritdoc}
     */
    public function min()
    {
        return $this->c == 0 ? 1 : 0;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return $this->x = (int) fmod($this->a * $this->x + $this->c, $this->m);
    }
}
