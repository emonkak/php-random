<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<float>
 */
class PiecewiseLinerDistribution extends AbstractDistribution
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
        assert(count($intervals) === count($densities));

        $probabilities = [];

        for ($i = 0, $l = count($intervals) - 1; $i < $l; $i++) {
            $width = $intervals[$i + 1] - $intervals[$i];
            $p1 = $densities[$i];
            $p2 = $densities[$i + 1];
            $probabilities[] = min($p1, $p2) * $width;
            $probabilities[] = abs($p1 - $p2) * $width / 2;
        }

        $this->intervals = $intervals;
        $this->densities = $densities;
        $this->discrete = new DiscreteDistribution($probabilities);
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
        $isInRectangle = ($i % 2 === 0);
        $i = (int) ($i / 2);

        $dist = new UniformRealDistribution(
            $this->intervals[$i],
            $this->intervals[$i + 1]
        );

        if ($isInRectangle) {
            return $dist->generate($engine);
        } elseif ($this->densities[$i] < $this->densities[$i + 1]) {
            return max($dist->generate($engine), $dist->generate($engine));
        } else {
            return min($dist->generate($engine), $dist->generate($engine));
        }
    }
}
