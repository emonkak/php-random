<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class DiscreteDistribution extends AbstractDistribution
{
    /**
     * @var float[]
     */
    private $probabilities;

    /**
     * @var UniformRealDistribution
     */
    private $uniform;

    /**
     * @param iterable $probabilities
     */
    public function __construct($probabilities)
    {
        assert(!empty($probabilities));

        $totalProbability = 0;

        foreach ($probabilities as $probability) {
            $totalProbability += $probability;
        }

        // TODO: Use alias table
        $this->probabilities = $probabilities;
        $this->uniform = new UniformRealDistribution(0, $totalProbability);
    }

    /**
     * @return float[]
     */
    public function getProbabilities()
    {
        return $this->probabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        $result = $this->uniform->generate($engine);
        $sum = 0;

        foreach ($this->probabilities as $key => $probability) {
            $sum += $probability;

            if ($probability > 0 && $result <= $sum) {
                return $key;
            }
        }

        throw new \LogicException("Can't generate the random number. Confirm the probabilities.");
    }
}
