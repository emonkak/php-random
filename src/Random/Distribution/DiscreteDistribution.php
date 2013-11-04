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
    private $weights;

    /**
     * @var UniformIntDistribution
     */
    private $uniform;

    /**
     * @param array $weights
     */
    public function __construct(array $weights)
    {
        $sum = 0;

        foreach ($weights as $weight) {
            $sum += $weight;
        }

        $this->weights = $weights;
        $this->uniform = new UniformIntDistribution(0, $sum);
    }

    /**
     * {@inheritdoc}
     * @throws LogicException
     */
    public function generate(AbstractEngine $engine)
    {
        $result = $this->uniform->generate($engine);
        $sum = 0;

        foreach ($this->weights as $key => $weight) {
            $sum += $weight;

            if ($result <= $sum) {
                return $key;
            }
        }

        throw new \LogicException('Generating number is not possible.');
    }
}
