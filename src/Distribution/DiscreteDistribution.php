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
     * @param float[] $probabilities
     */
    public function __construct(array $probabilities)
    {
        assert(!empty($probabilities));

        // TODO: Use alias table
        $this->probabilities = $probabilities;
        $this->uniform =
            new UniformRealDistribution(0, array_sum($probabilities));
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

            if ($result <= $sum) {
                return $key;
            }
        }

        throw new \LogicException("Can't generate the random number. Please confirm the probabilities.");
    }
}
