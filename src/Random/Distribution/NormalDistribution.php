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

class NormalDistribution extends AbstractDistribution
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
     * @var float
     */
    private $next;

    /**
     * @param float $mean
     * @param float $sigma
     */
    public function __construct($mean, $sigma)
    {
        assert($sigma >= 0);

        $this->mean = $mean;
        $this->sigma = $sigma;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        if ($this->next === null) {
            do {
                $x = 2.0 * $engine->nextFloat() - 1.0;
                $y = 2.0 * $engine->nextFloat() - 1.0;
                $r2 = $x * $x + $y * $y;
            } while ($r2 > 1.0 || $r2 == 0.0);

            $m = sqrt(-2 * log($r2) / $r2);

            $this->next = $x * $m;
            $result = $y * $m;
        } else {
            $result = $this->next;
            $this->next = null;
        }

        return $result * $this->sigma + $this->mean;
    }
}
