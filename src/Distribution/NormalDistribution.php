<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<float>
 */
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

    public function __construct(float $mean, float $sigma)
    {
        assert($sigma >= 0);

        $this->mean = $mean;
        $this->sigma = $sigma;
    }

    public function getMean(): float
    {
        return $this->mean;
    }

    public function getSigma(): float
    {
        return $this->sigma;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(EngineInterface $engine)
    {
        $r1 = $engine->nextDouble();
        $r2 = $engine->nextDouble();

        return $this->mean + $this->sigma
               * sqrt(-2 * log($r1)) * cos(2 * M_PI * $r2);
    }
}
