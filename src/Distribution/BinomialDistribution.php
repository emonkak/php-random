<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class BinomialDistribution extends AbstractDistribution
{
    /**
     * @var integer
     */
    private $n;

    /**
     * @var float
     */
    private $probability;

    /**
     * @param integer $t
     * @param float $p
     */
    public function __construct($t, $p)
    {
        assert(0 <= $t);
        assert(0 <= $p && $p <= 1);

        $this->t = $t;
        $this->p = $p;
    }

    /**
     * @return integer
     */
    public function getT()
    {
        return $this->t;
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
            return 0;
        }

        $success = 0;
        $min = $engine->min();
        $max = $engine->max();

        for ($i = 0; $i < $this->t; ++$i) {
            if (($engine->next() - $min) <= $this->p * ($max - $min)) {
                $success++;
            }
        }

        return $success;
    }
}
