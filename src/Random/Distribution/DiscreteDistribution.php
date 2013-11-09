<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

use Random\Engine\AbstractEngine;

class DiscreteDistribution extends AbstractDistribution
{
    /**
     * @var array
     */
    private $probabilities;

    /**
     * @var UniformRealDistribution
     */
    private $uniform;

    /**
     * @param array $probabilities
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
     * @return array
     */
    public function getProbabilities()
    {
        return $this->probabilities;
    }

    /**
     * {@inheritdoc}
     * @throws LogicException
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

        throw new \LogicException('Generating number is not possible.');
    }
}
