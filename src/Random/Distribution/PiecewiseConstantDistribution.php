<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

use Random\Engine\AbstractEngine;

class PiecewiseConstantDistribution extends UniformIntDistribution
{
    /**
     * @var array
     */
    private $intervals;

    /**
     * @var array
     */
    private $densities;

    /**
     * @var DiscreteDistribution
     */
    private $discreteDistribution;

    /**
     * @param array $intervals
     * @param array $densities
     */
    public function __construct(array $intervals, array $densities)
    {
        assert(count($intervals) === count($densities) + 1);

        $this->intervals = $intervals;
        $this->densities = $densities;
        $this->discreteDistribution = new DiscreteDistribution($densities);
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        $index = $this->discreteDistribution->generate($engine);
        $begin = $this->intervals[$index];
        $end = $this->intervals[$index + 1];

        $uniformRealDistribution = new UniformRealDistribution($begin, $end);

        return $uniformRealDistribution->generate($engine);
    }
}
