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

class GeometricDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $probability;

    /**
     * @param float $probability
     */
    public function __construct($probability)
    {
        assert(0 < $probability && $probability < 1);

        $this->probability = $probability;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        $result = log(1 - $engine->nextFloat()) / log(1 - $this->probability);

        return (int) $result;
    }
}
