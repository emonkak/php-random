<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class UniformRealDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $min;

    /**
     * @var float
     */
    private $max;

    /**
     * @param float $min
     * @param float $max
     */
    public function __construct($min, $max)
    {
        assert($min < $max);

        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return integer
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return integer
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        return $this->min + ($this->max - $this->min) * $engine->nextDouble();
    }
}
