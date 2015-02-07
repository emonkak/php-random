<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Engine;

use Emonkak\Random\Util\Bits;

class XorShift128Engine extends AbstractEngine
{
    const X = 123456789;
    const Y = 362436069;
    const Z = 521288629;
    const W = 88675123;

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
     * @param integer $seed The initial seed
     */
    public static function from($seed)
    {
        // https://gist.github.com/gintenlabo/604721
        return new XorShift128Engine(
            self::X ^  $seed                                  & 0xffffffff,
            self::Y ^ ($seed << 17) | Bits::shiftR($seed, 15) & 0xffffffff,
            self::Z ^ ($seed << 31) | Bits::shiftR($seed,  1) & 0xffffffff,
            self::W ^ ($seed << 18) | Bits::shiftR($seed, 14) & 0xffffffff
        );
    }

    /**
     * @param integer $x The first seed
     * @param integer $y The sedond seed
     * @param integer $z The third seed
     * @param integer $w The fourth seed
     */
    public function __construct($x, $y, $z, $w)
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
        return 0x7fffffff;
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
        $this->w = ($this->w ^ Bits::shiftR($this->w, 19) ^ ($t ^ Bits::shiftR($t, 8))) & 0xffffffff;

        // Kill the sign bit for 32bit systems.
        return $this->w & 0x7fffffff;
    }
}
