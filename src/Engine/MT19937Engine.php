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

class MT19937Engine extends AbstractEngine
{
    const N = 624;
    const M = 397;

    /**
     * @var integer
     */
    private $seed;

    /**
     * @var \SplFixedArray
     */
    private $state;

    /**
     * @var integer
     */
    private $left = 0;

    /**
     * @return MT19937Engine
     */
    public static function create()
    {
        return new self((time() * getmypid()) ^ (1000000.0 * lcg_value()));
    }

    /**
     * @param integer The initial seed
     */
    public function __construct($seed)
    {
        $this->state = new \SplFixedArray(self::N + 1);
        $this->seed($seed);
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
        if ($this->left === 0) {
            $this->nextSeed();
        }

        $this->left--;

        $s1 = $this->state->current();
        $s1 ^= Bits::shiftR($s1, 11);
        $s1 ^= ($s1 <<  7) & 0x9d2c5680;
        $s1 ^= ($s1 << 15) & 0xefc60000;

        $this->state->next();

        return Bits::shiftR($s1 ^ Bits::shiftR($s1, 18), 1);
    }

    /**
     * {@inheritdoc}
     */
    private function seed($seed)
    {
        $this->state[0] = $seed & 0xffffffff;

        for ($i = 1; $i < self::N; $i++) {
            $r = $this->state[$i - 1];
            $this->state[$i] =
                Bits::multiply(1812433253,
                               $r ^ Bits::shiftR($r, 30)) + $i & 0xffffffff;
        }
    }

    /**
     * @return void
     */
    private function nextSeed()
    {
        for ($i = 0, $l = self::N - self::M; $i < $l; $i++) {
            $this->state[$i] = Bits::twist(
                $this->state[$i + self::M],
                $this->state[$i],
                $this->state[$i + 1]
            );
        }

        for ($l = self::N - 1; $i < $l; $i++) {
            $this->state[$i] = Bits::twist(
                $this->state[$i + self::M - self::N],
                $this->state[$i],
                $this->state[$i + 1]
            );
        }

        $this->state[$i] = Bits::twist(
            $this->state[$i + self::M - self::N],
            $this->state[$i],
            $this->state[0]
        );

        $this->left = self::N;

        $this->state->rewind();
    }
}
