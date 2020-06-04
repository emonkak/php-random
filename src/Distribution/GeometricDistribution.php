<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<int>
 */
class GeometricDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $p;

    public function __construct(float $p)
    {
        assert(0 < $p && $p < 1);

        $this->p = $p;
    }

    public function getP(): float
    {
        return $this->p;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(EngineInterface $engine)
    {
        $result = log(1 - $engine->nextDouble()) / log(1 - $this->p);

        return (int) $result;
    }
}
