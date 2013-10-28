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
     * @var integer
     */
    private $sum = 0;

    /**
     * @param array $weights
     */
    public function __construct(array $weights)
    {
        $this->weights = $weights;

        foreach ($weights as $weight) {
            $this->sum += $weight;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        $uniform = new UniformIntDistribution(0, $this->sum);

        $result = $uniform->generate($engine);
        $sum = 0;

        foreach ($this->weights as $key => $weight) {
            $sum += $weight;

            if ($result <= $sum) {
                return $key;
            }
        }

        return null;
    }
}
