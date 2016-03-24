<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class GeometricDistribution extends AbstractDistribution
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
        assert(0 < $p && $p < 1);

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
        $result = log(1 - $engine->nextDouble()) / log(1 - $this->p);

        return (int) $result;
    }
}
