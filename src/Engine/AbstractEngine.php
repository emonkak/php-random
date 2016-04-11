<?php

namespace Emonkak\Random\Engine;

abstract class AbstractEngine implements \IteratorAggregate
{
    const DBL_MANT_DIG = 53;

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->next();
    }

    /**
     * @see \IteratorAggregate
     * @return \Iterator
     */
    public function getIterator()
    {
        return new EngineIterator($this);
    }

    /**
     * Advances the internal state by z notches.
     *
     * @param integer $z
     */
    public function discard($z)
    {
        while ($z-- > 0) {
            $this->next();
        }
    }

    /**
     * Returns the maximum number that will be generated.
     *
     * @return integer
     */
    abstract public function max();

    /**
     * Returns the minimum number that will be generated.
     *
     * @return integer
     */
    abstract public function min();

    /**
     * Returns a random number.
     *
     * @return integer
     */
    abstract public function next();

    /**
     * Returns a random number that is greater than or equal to 0 and less than 1.
     *
     * @return float
     */
    public function nextDouble()
    {
        $max = $this->max();
        $min = $this->min();

        $logR = log($max + $min + 1, 2);

        $k = self::DBL_MANT_DIG / $logR + (self::DBL_MANT_DIG % $logR != 0);
        $rp = $max - $min + 1;

        $base = $rp;
        $sp = $this->next() - $min;

        for ($i = 1; $i < $k; ++$i, $base *= $rp) {
            $sp += ($this->next() - $min) * $base;
        }

        return $sp / $base;
    }
}
