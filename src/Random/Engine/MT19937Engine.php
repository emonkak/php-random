<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class MT19937Engine extends Engine
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
    private $left;

    /**
     * @param integer|null Initial seed
     */
    public function __construct($seed = null)
    {
        $this->seed = $seed === null
                    ? (time() * getmypid()) ^ (1000000.0 * lcg_value())
                    : $seed;
        $this->state = new \SplFixedArray(self::N + 1);

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
        return 0x7fffffff;
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
        if ($this->left === 0) {
            $this->nextSeed();
        }

        $this->left--;

        $s1 = $this->state->current();
        $s1 ^= ($s1 >> 11);
        $s1 ^= ($s1 <<  7) & 0x9d2c5680;
        $s1 ^= ($s1 << 15) & 0xefc60000;

        $this->state->next();

        return ($s1 ^ ($s1 >> 18)) >> 1;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->state[0] = $this->seed & 0xffffffff;

        for ($i = 1; $i < self::N; $i++) {
            $r = $this->state[$i - 1];
            $this->state[$i] = (1812433253 * ($r ^ ($r >> 30)) + $i) & 0xffffffff;
        }

        $this->left = 0;
    }

    /**
     * @return void
     */
    private function nextSeed()
    {
        for ($i = 0, $l = self::N - self::M; $i < $l; $i++) {
            $this->state[$i] = self::twist(
                $this->state[$i + self::M],
                $this->state[$i],
                $this->state[$i + 1]
            );
        }

        for ($l = self::N - 1; $i < $l; $i++) {
            $this->state[$i] = self::twist(
                $this->state[$i + self::M - self::N],
                $this->state[$i],
                $this->state[$i + 1]
            );
        }

        $this->state[$i] = self::twist(
            $this->state[$i + self::M - self::N],
            $this->state[$i],
            $this->state[0]
        );

        $this->left = self::N;

        $this->state->rewind();
    }

    /**
     * @return void
     */
    private function twist($m, $u, $v)
    {
        return ($m ^ ((($u & 0x80000000) | ($v & 0x7FFFFFFF)) >> 1)
                   ^ -($u & 0x00000001) & 0x9908B0DF);
    }
}
