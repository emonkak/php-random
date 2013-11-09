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

class ExponentialDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $lambda;

    /**
     * @param float $probability
     */
    public function __construct($lambda = 1.0)
    {
        assert($lambda > 0);

        $this->lambda = $lambda;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        return -1 / $this->lambda * log(1 - $engine->nextFloat());
    }
}
