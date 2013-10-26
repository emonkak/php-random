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
     * @param interger $probability
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
        if ($engine->nextDouble() < $this->probability) {
            return true;
        } else {
            return false;
        }
    }
}
