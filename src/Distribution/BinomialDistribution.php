<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<int>
 */
class BinomialDistribution extends AbstractDistribution
{
    /**
     * @var int
     */
    private $t;

    /**
     * @var float
     */
    private $p;

    public function __construct(int $t, float $p)
    {
        assert(0 <= $t);
        assert(0 <= $p && $p <= 1);

        $this->t = $t;
        $this->p = $p;
    }

    public function getT(): int
    {
        return $this->t;
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
            return 0;
        }

        $success = 0;
        $min = $engine->min();
        $max = $engine->max();

        for ($i = 0; $i < $this->t; ++$i) {
            if (($engine->next() - $min) <= $this->p * ($max - $min)) {
                $success++;
            }
        }

        return $success;
    }
}
