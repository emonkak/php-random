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

class NormalDistribution extends Distribution
{
    /**
     * @var float
     */
    private $mean;

    /**
     * @var float
     */
    private $sigma;

    /**
     * @param float $mean
     * @param float $sigma
     */
    public function __construct($mean, $sigma)
    {
        $this->mean = $mean;
        $this->sigma = $sigma;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(Engine $engine)
    {
        $r1 = $engine->nextDouble();
        $r2 = $engine->nextDouble();

        while ($r1 == 0) {
            $r1 = $engine->nextDouble();
        }

        return $this->sigma * sqrt(-2 * log($r1)) * sin(2 * M_PI * $r2) + $this->mean;
    }
}
