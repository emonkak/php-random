<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<float>
 */
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

    public function __construct(float $min, float $max)
    {
        assert($min < $max);

        $this->min = $min;
        $this->max = $max;
    }

    public function getMin(): float
    {
        return $this->min;
    }

    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(EngineInterface $engine)
    {
        return $this->min + ($this->max - $this->min) * $engine->nextDouble();
    }
}
