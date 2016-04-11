<?php

namespace Emonkak\Random\Engine;

abstract class AbstractEngine implements \IteratorAggregate
{
    const DBL_MANT_DIG = 53;
    const DBL_EPSILON = 2.2204460492503131e-16;

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
        $b = self::DBL_MANT_DIG;
        $r = $max - $min + 1;
        $mult = $r;
        $limit = pow(2, $b);
        $s = $this->next() - $min;
        while ($mult < $limit) {
            $s += ($this->next() - $min) * $mult;
            $mult *= $r;
        }
        $result = $s / $mult;
        if ($result == 1) {
            $result -= self::DBL_EPSILON / 2;
        }
        return $result;
    }
}
