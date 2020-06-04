<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<float>
 */
class ExponentialDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $lambda;

    public function __construct(float $lambda = 1.0)
    {
        assert($lambda > 0);

        $this->lambda = $lambda;
    }

    public function getLambda(): float
    {
        return $this->lambda;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(EngineInterface $engine)
    {
        return -1 / $this->lambda * log(1 - $engine->nextDouble());
    }
}
