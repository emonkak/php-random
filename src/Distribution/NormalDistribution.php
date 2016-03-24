<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class NormalDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $mean;

    /**
     * @var float
     */
    private $sigma;

    /**
     * @param float $mean
     * @param float $sigma
     */
    public function __construct($mean, $sigma)
    {
        assert($sigma >= 0);

        $this->mean = $mean;
        $this->sigma = $sigma;
    }

    /**
     * @return float
     */
    public function getMean()
    {
        return $this->mean;
    }

    /**
     * @return float
     */
    public function getSigma()
    {
        return $this->sigma;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        $r1 = $engine->nextDouble();
        $r2 = $engine->nextDouble();

        return $this->mean + $this->sigma
               * sqrt(-2 * log($r1)) * cos(2 * M_PI * $r2);
    }
}
