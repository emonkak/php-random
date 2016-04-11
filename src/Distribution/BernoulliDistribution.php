<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class BernoulliDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $p;

    /**
     * @param float $p
     */
    public function __construct($p)
    {
        assert(0 <= $p && $p <= 1);

        $this->p = $p;
    }

    /**
     * @return float
     */
    public function getP()
    {
        return $this->p;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        if ($this->p == 0) {
            return false;
        }
        $min = $engine->min();
        $max = $engine->max();
        return ($engine->next() - $min) <= $this->p * ($max - $min);
    }
}
