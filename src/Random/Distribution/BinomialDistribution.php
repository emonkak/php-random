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

class BinomialDistribution extends AbstractDistribution
{
    /**
     * @var integer
     */
    private $n;

    /**
     * @var float
     */
    private $probability;

    /**
     * @param integer $n
     * @param float $probability
     */
    public function __construct($n, $probability)
    {
        $this->n = $n;
        $this->probability = $probability;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        $count = 0;

        for ($n = $this->n; $n > 0; $n--) {
            if ($engine->nextDouble() < $this->probability) {
                $count++;
            }
        }

        return $count;
    }
}
