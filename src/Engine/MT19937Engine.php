<?php

namespace Emonkak\Random\Engine;

use Emonkak\Random\Utils\BitUtils;

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
    private $remains = 0;

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
        if ($this->remains === 0) {
            $this->nextSeed();
        }

        $this->remains--;

        $s1 = $this->tempering($this->state->current());

        $this->state->next();

        return $s1;
    }

    /**
     * @param integer $x
     * @return integer
     */
    private function tempering($x)
    {
        $x ^= BitUtils::shiftR($x, 11);
        $x ^= ($x <<  7) & 0x9d2c5680;
        $x ^= ($x << 15) & 0xefc60000;
        $x ^= BitUtils::shiftR($x, 18);
        return BitUtils::shiftR($x, 1);
    }

    /**
     * @param integer $seed
     */
    private function seed($seed)
    {
        $this->state[0] = $seed & 0xffffffff;

        for ($i = 1; $i < self::N; $i++) {
            $r = $this->state[$i - 1];
            $this->state[$i] =
                BitUtils::multiply(1812433253,
                                   $r ^ BitUtils::shiftR($r, 30)) + $i & 0xffffffff;
        }
    }

    /**
     * @return void
     */
    private function nextSeed()
    {
        for ($i = 0, $l = self::N - self::M; $i < $l; $i++) {
            $this->state[$i] = BitUtils::twist(
                $this->state[$i + self::M],
                $this->state[$i],
                $this->state[$i + 1]
            );
        }

        for ($l = self::N - 1; $i < $l; $i++) {
            $this->state[$i] = BitUtils::twist(
                $this->state[$i + self::M - self::N],
                $this->state[$i],
                $this->state[$i + 1]
            );
        }

        $this->state[$i] = BitUtils::twist(
            $this->state[$i + self::M - self::N],
            $this->state[$i],
            $this->state[0]
        );

        $this->remains = self::N;

        $this->state->rewind();
    }
}
