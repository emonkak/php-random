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

class PiecewiseConstantDistribution extends AbstractDistribution
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
        $i = $this->discreteDistribution->generate($engine);
        $dist = new UniformRealDistribution(
            $this->intervals[$i],
            $this->intervals[$i + 1]
        );

        return $dist->generate($engine);
    }
}
