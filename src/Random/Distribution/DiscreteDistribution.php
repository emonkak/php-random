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
    private $uniformRealDistribution;

    /**
     * @param array $probabilities
     */
    public function __construct(array $probabilities)
    {
        assert(!empty($probabilities));

        $this->probabilities = $probabilities;
        $this->uniformRealDistribution =
            new UniformRealDistribution(0, array_sum($probabilities));
    }

    /**
     * {@inheritdoc}
     * @throws LogicException
     */
    public function generate(AbstractEngine $engine)
    {
        $result = $this->uniformRealDistribution->generate($engine);
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
