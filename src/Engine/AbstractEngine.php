<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

abstract class AbstractEngine implements EngineInterface
{
    const DBL_MANT_DIG = 53;
    const DBL_EPSILON = 2.2204460492503131e-16;

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \Traversable
    {
        while (true) {
            yield $this->next();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function discard(int $z): void
    {
        while ($z-- > 0) {
            $this->next();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function nextDouble(): float
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
