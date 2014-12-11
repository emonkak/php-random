<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class PiecewiseConstantDistribution extends AbstractDistribution
{
    /**
     * @var float[]
     */
    private $intervals;

    /**
     * @var float[]
     */
    private $densities;

    /**
     * @var DiscreteDistribution
     */
    private $discrete;

    /**
     * @param float[] $intervals
     * @param float[] $densities
     */
    public function __construct(array $intervals, array $densities)
    {
        assert(count($intervals) === count($densities) + 1);

        $this->intervals = $intervals;
        $this->densities = $densities;
        $this->discrete = new DiscreteDistribution($densities);
    }

    /**
     * @return float[]
     */
    public function getIntervals()
    {
        return $this->intervals;
    }

    /**
     * @return float[]
     */
    public function getDensities()
    {
        return $this->densities;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        $i = $this->discrete->generate($engine);
        $dist = new UniformRealDistribution(
            $this->intervals[$i],
            $this->intervals[$i + 1]
        );

        return $dist->generate($engine);
    }
}
