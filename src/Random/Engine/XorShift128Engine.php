<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class XorShift128Engine extends Engine
{
    const SEED_X = 123456789;
    const SEED_Y = 362436069;
    const SEED_Z = 521288629;
    const SEED_W = 88675123;

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
     * @var integer
     */
    private $seed;

    /**
     * @param integer|null Initial seed
     */
    public function __construct($seed = null)
    {
        $this->seed = $seed === null
                    ? ((time() * getmypid()) ^ (1000000.0 * lcg_value()))
                    : $seed;

        $this->reset();
    }

    /**
     * {@inheritdoc}
     */
    public function canReset()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function maximum()
    {
        return 0xffffffff;
    }

    /**
     * {@inheritdoc}
     */
    public function minimum()
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

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->x = self::SEED_X ^  $this->seed                              & 0xffffffff;
        $this->y = self::SEED_Y ^ ($this->seed <<  8) | ($this->seed >> 24) & 0xffffffff;
        $this->z = self::SEED_Z ^ ($this->seed << 16) | ($this->seed >> 16) & 0xffffffff;
        $this->w = self::SEED_W ^ ($this->seed << 24) | ($this->seed >>  8) & 0xffffffff;
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
