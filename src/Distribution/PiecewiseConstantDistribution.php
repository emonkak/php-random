<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<float>
 */
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
    public function getIntervals(): array
    {
        return $this->intervals;
    }

    /**
     * @return float[]
     */
    public function getDensities(): array
    {
        return $this->densities;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(EngineInterface $engine)
    {
        $i = $this->discrete->generate($engine);
        $dist = new UniformRealDistribution(
            $this->intervals[$i],
            $this->intervals[$i + 1]
        );

        return $dist->generate($engine);
    }
}
