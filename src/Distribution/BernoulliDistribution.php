<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<bool>
 */
class BernoulliDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $p;

    public function __construct(float $p)
    {
        assert(0 <= $p && $p <= 1);

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
        if ($this->p == 0) {
            return false;
        }
        $min = $engine->min();
        $max = $engine->max();
        return ($engine->next() - $min) <= $this->p * ($max - $min);
    }
}
