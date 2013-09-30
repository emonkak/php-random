<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

use Random\Engine\Engine;

class BernoulliDistribution extends Distribution
{
    /**
     * @var integer
     */
    private $alpha;

    /**
     * @param interger $alpha
     */
    public function __construct($alpha)
    {
        $this->alpha = $alpha;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(Engine $engine)
    {
        if ($engine->nextDouble() < $this->alpha) {
            return 1.0;
        } else {
            return 0.0;
        }
    }
}
