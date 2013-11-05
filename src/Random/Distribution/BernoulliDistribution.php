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

class BernoulliDistribution extends AbstractDistribution
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
        $this->probability = $probability;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        return $engine->nextDouble() <= $this->probability;
    }
}
