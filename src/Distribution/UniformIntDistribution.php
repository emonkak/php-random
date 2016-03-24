<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class UniformIntDistribution extends AbstractDistribution
{
    /**
     * @var integer
     */
    private $min;

    /**
     * @var integer
     */
    private $max;

    /**
     * @param integer $min
     * @param integer $max
     */
    public function __construct($min, $max)
    {
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
        return (int) floor($this->min + ($this->max - $this->min + 1.0)
                                      * $engine->nextDouble());
    }
}
