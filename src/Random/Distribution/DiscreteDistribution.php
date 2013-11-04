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

class DiscreteDistribution extends UniformIntDistribution
{
    /**
     * @var array
     */
    private $weights;

    /**
     * @param array $weights
     */
    public function __construct(array $weights)
    {
        parent::__construct(0, array_sum($weights));

        $this->weights = $weights;
    }

    /**
     * {@inheritdoc}
     * @throws LogicException
     */
    public function generate(AbstractEngine $engine)
    {
        $result = parent::generate($engine);
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
