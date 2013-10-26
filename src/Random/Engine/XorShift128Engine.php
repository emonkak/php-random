<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class XorShift128Engine extends AbstractEngine
{
    /**
     * @var integer
     */
    private $x;

    /**
     * @var integer
     */
    private $y;

    /**
     * @var integer
     */
    private $z;

    /**
     * @var integer
     */
    private $w;

    /**
     * @param integer $x
     * @param integer $y
     * @param integer $z
     * @param integer $w
     */
    public function __construct($x = 123456789, $y = 362436069, $z = 521288629, $w = 88675123)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->w = $w;
    }

    /**
     * {@inheritdoc}
     */
    public function max()
    {
        return 0xffffffff;
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
        $t = ($this->x ^ ($this->x << 11)) & 0xffffffff;

        $this->x = $this->y;
        $this->y = $this->z;
        $this->z = $this->w;
        $this->w = ($this->w ^ ($this->w >> 19) ^ ($t ^ ($t >> 8))) & 0xffffffff;

        return $this->w;
    }
}
